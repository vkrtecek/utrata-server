<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:49
 */

namespace App\Model\Service;


use App\Model\Dao\IMemberDAO;
use App\Model\Entity\Currency;
use App\Model\Entity\Language;
use App\Model\Entity\Member;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\SecurityException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use DateTime;

class MemberService implements IMemberService
{
	const defaultPassword = 'Facebook Password';

	/** @var IMemberDAO */
	protected $memberDao;

	/** @var ILanguageService */
	protected $languageService;

	/** @var ICurrencyService */
	protected $currencyService;

	/**
	 * MemberService constructor.
	 * @param IMemberDAO $memberDao
	 * @param ILanguageService $languageService
	 * @param ICurrencyService $currencyService
	 */
	public function __construct(IMemberDAO $memberDao, ILanguageService $languageService, ICurrencyService $currencyService)
	{
		$this->memberDao = $memberDao;
		$this->languageService = $languageService;
		$this->currencyService = $currencyService;
	}

	/**
	 * @return Member[]
	 * @throws NotFoundException
	 */
	public function getMembers() {
		$members = $this->memberDao->findAll();
		if ($members == NULL)
			throw new NotFoundException('MemberService: No result.');
		return $members;
	}


	/**
	 * @param string $login
	 * @return Member
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getMember($login) {
		$member = $this->memberDao->findOne($login);
		if ($member == NULL)
			throw new NotFoundException('Member with this login not found.');
		return $member;
	}

	/**
	 * @param string $token
	 * @return Member
	 * @throws NotFoundException
	 */
	public function getByToken($token) {
		$member = $this->memberDao->findOneByColumn('token', $token);
		if ($member == NULL)
			throw new NotFoundException('Member with this token not found.');
		return $member;
	}

	/**
	 * @param $data
	 * @return Member
	 * @throws AlreadyExistException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 */
	public function createMember($data)
	{
		$member = new Member();
		if (!isset($data['login']))
			throw new BadParameterException('MemberService: "login" not specified.');
		try {
			$this->getMember($data['login']);
			throw new AlreadyExistException('MemberService: Member with this login already exists.');
		} catch (NotFoundException $ex) {
			$this->setMember($member, $data);
			return $this->memberDao->create($member);
		}
	}

	/**
	 * @param string $login
	 * @param $data
	 * @return Member
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 */
	public function updateMember($login, $data) {
		try {
			$member = $this->getMember($login);
		} catch (NotFoundException $ex) {
			throw new NotFoundException('MemberService: No member with this login.', 0, $ex);
		}
		$this->setMember($member, $data, FALSE);
		return $this->memberDao->update($member);
	}

	/**
	 * @param string $login
	 * @return string
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteMember($login) {
		try {
			//test if member exists
			$member = $this->getMember($login);
			return $this->memberDao->delete($member);
		} catch (NotFoundException $ex) {
			throw new NotFoundException('MemberService: No member with this login.', 0, $ex);
		}
	}

	/**
	 * logs in or creates new account to user
	 * @param $fb_data = {name, fname, lname, id, email, locale}
	 * @return int
	 * @throws BadParameterException
	 */
	public function interactWithFacebook($fb_data) {
		$inputsKeys = [ 'fname', 'lname', 'id', 'email', 'locale' ];
		foreach ($inputsKeys as $key) {
			if (!isset($fb_data[$key]) || $fb_data[$key] == '')
				throw new BadParameterException('MemberService: "' . $key . '" must be specified.');
		}

		if (!preg_match('/[1-9][0-9]*/', $fb_data['id']))
			throw new BadParameterException('MemberService: ID is not INTEGER or smaller than 1.');

		$data = [];
		$data['id'] = $fb_data['id'];
		$data['firstName'] = $fb_data['fname'];
		$data['lastName'] = $fb_data['lname'];
		$data['login'] = $fb_data['id'];
		$data['passwordHash'] = self::defaultPassword;
		$data['mother'] = $fb_data['email'];
		$data['me'] = $fb_data['email'];
		$data['expiration'] = (new DateTime('+ 14 days'))->format('Y-m-d H:i:s');
		$data['access'] = (new DateTime())->format('Y-m-d H:i:s');
		$data['currencyCode'] = $this->getCurrencyFromLocale($fb_data['locale'])->getCode();
		$data['languageCode'] = $this->getLanguageFromLocale($fb_data['locale'])->getCode();
		$data['facebook'] = true;

		$member = new Member();
		try {
			$this->getMemberByColumn('login', $data['id']);
			return IMemberService::FACEBOOK_LOGGED;
		} catch (NotFoundException $ex) {
			$member->setId($data['id']);
			$this->setMember($member, $data);
			$this->memberDao->create($member);
			return IMemberService::FACEBOOK_SIGNED;
		}
	}

	/**
	 * @param Member $member
	 * @return Member
	 */
	public function logout(Member $member) {
		$member->setExpiration(new \DateTime());
		$member->setToken('');
		return $this->memberDao->update($member);
	}


	/**
	 * @param Member $member
	 * @param array $data
	 * @param boolean $newEntity
	 * @throws BadRequestHttpException
	 * @throws NotFoundException
	 */
	protected function setMember(Member $member, array $data, $newEntity = TRUE) {
		$dateFormat = '/^2[0-1][0-9][0-9]-[0-1][0-9]-[0-3][0-9] [0-2][0-9]:[0-5][0-9]:[0-5][0-9].[0-9]*$/';

		if ((!isset($data['currency']) || $data['currency'] == NULL) && $newEntity)
			throw new BadRequestHttpException('MemberService: Currency must be specified.');
		else  if (isset($data['currency']) && $data['currency']) {
			if ($data['currency'] instanceof Currency) {
				$member->setCurrency($data['currency']);
			} else {
				try {
					//$member->setCurrency($this->currencyService->getCurrency($data['currency']['currencyId']));
				} catch (NotFoundException $ex) {
					throw new NotFoundException('MemberService: No Currency found with given id.', 0, $ex);
				}
			}
		}


		if ((!isset($data['language']) || $data['language'] == NULL) && $newEntity)
			throw new BadRequestHttpException('MemberService: Language must be specified.');
		else if (isset($data['language']) && $data['language']) {
			if ($data['language'] instanceof Language) {
				$member->setLanguage($data['language']);
			} else {
				try {
					//$member->setLanguage($this->languageService->getLanguage($data['language']['languageCode']));
				} catch (NotFoundException $ex) {
					throw new NotFoundException('MemberService: No language found with given code.', 0, $ex);
				}
			}
		}


		if ((!isset($data['login']) || $data['login'] == NULL) && $newEntity)
			throw new BadRequestHttpException('MemberService: "login" must be specified.');
		else if (isset($data['login']) && $data['login'])
			$member->setLogin($data['login']);


		if ((!isset($data['passwordHash']) || $data['passwordHash'] == NULL) && $newEntity)
			throw new BadRequestHttpException('MemberService: "passwordHash" must be specified.');
		else if (isset($data['passwordHash']) && $data['passwordHash'])
			$member->setPassword($this->getPasswordHash($data['passwordHash']));


		if ((!isset($data['mother']) || $data['mother'] == NULL) && $newEntity)
			throw new BadRequestHttpException('MemberService: "mother" must be specified.');
		else if (isset($data['mother']) && $data['mother'])
			$member->setMotherMail($data['mother']);


		if ((!isset($data['me']) || $data['me'] == NULL) && $newEntity)
			throw new BadRequestHttpException('MemberService: "me" must be specified.');
		else if (isset($data['me']) && $data['me'])
			$member->setMyMail($data['me']);


		if (isset($data['sendMonthly'])) $member->setSendMonthly($data['sendMonthly']);
		if (isset($data['sendByOne'])) $member->setSendByOne($data['sendByOne']);
		if (isset($data['admin'])) $member->setAdmin($data['admin']);
		if (isset($data['logged'])) $member->setLogged($data['logged']);
		if (isset($data['access'])) {
			if (!($data['access'] instanceof \DateTime) && !preg_match($dateFormat, $data['access']))
				throw new BadRequestHttpException('MemberService: field "access" has bad format');
			$member->setAccess(new DateTime($data['access']));
		}
		if (isset($data['facebook'])) $member->setFacebook($data['facebook']);
		if (isset($data['expiration'])) {
			if (!($data['expiration'] instanceof \DateTime) && !preg_match($dateFormat, $data['expiration']))
				throw new BadRequestHttpException('MemberService: field "expiration" has bad format');
			$member->setExpiration(new DateTime($data['expiration']));
		}
		if (isset($data['firstName'])) $member->setFirstName($data['firstName']);
		if (isset($data['lastName'])) $member->setLastName($data['lastName']);

	}

	/**
	 * @param $locale
	 * @return Currency|null
	 */
	protected function getCurrencyFromLocale($locale) {
		$currency = NULL;
		//if (preg_match('/cs_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'CZK');
		//if (preg_match('/en_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'EUR');
		//if (preg_match('/sk_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'EUR');

		return $currency;
	}

	/**
	 * @param string $locale
	 * @return Language|null
	 */
	protected function getLanguageFromLocale($locale) {
		$language = NULL;
		//if (preg_match('/cs_.*/', $locale)) $language = $this->languageService->getLanguage('CZK');
		//if (preg_match('/en_.*/', $locale)) $language = $this->languageService->getLanguage('ENG');
		//if (preg_match('/sk_.*/', $locale)) $language = $this->languageService->getLanguage('SVK');

		return $language;
	}

	/**
	 * @param string $column
	 * @param mixed $login
	 * @return Member|NULL
	 * @throws NotFoundException
	 */
	public function getMemberByColumn($column, $login) {
		$member = $this->memberDao->findOneByColumn($column, $login);
		if ($member == NULL)
			throw new NotFoundException('Member with this ' . $column . ' not found.');
		return $member;
	}

	/**
	 * @param string $login
	 * @param string $password
	 * @return Member
	 * @throws SecurityException
	 */
	public function login($login, $password) {
		try {
			$member = $this->getMemberByColumn('login', $login);
			if (!self::verifyPasswordHash($member->getPassword(), $password))
				throw new SecurityException('Bad password');
			$token = $this->createToken();
			$member->setToken($token);
			$member->setAccess(new DateTime());
			$member->setExpiration(new DateTime('+ 1 day'));
			$this->memberDao->update($member);
			return $member;
		} catch (NotFoundException $ex) {
			throw new SecurityException($ex->getMessage());
		}
	}

	/**
	 * @param $login
	 * @return Member
	 */
	public function loginByFacebook($login) {
		$member = $this->getMemberByColumn('login', $login);
		$token = $this->createToken();
		$member->setToken($token);
		$member->setAccess(new DateTime());
		$member->setExpiration(new DateTime('+ 14 days'));
		$this->memberDao->update($member);
		return $member;
	}

	/**
	 * @param Member $member
	 * @return array
	 */
	public static function format(Member $member) {
		$ret = [];

		$ret['id'] = $member->getId();
		$ret['firstName'] = $member->getFirstName();
		$ret['lastName'] = $member->getLastName();
		$ret['login'] = $member->getLogin();
		$ret['sendMonthly'] = $member->shouldSendMonthly();
		$ret['sendByOne'] = $member->shouldSendByOne();
		$ret['mother'] = $member->getMotherMail();
		$ret['me'] = $member->getMyMail();
		$ret['token'] = $member->getToken();
		$ret['languageCode'] = $member->getLanguage()->getCode();
		$ret['currencyCode'] = $member->getCurrency()->getCode();
		$ret['lastLogged'] = $member->getAccess()->format('Y-m-d H:i:s');
		$ret['purposes'] = MemberService::getFormattedPurposes($member);

		return $ret;
	}

	/**
	 * @param Member $member
	 * @return array
	 */
	public static function getFormattedPurposes(Member $member) {
		$ret = [];
		if ($member->getMemberPurposes() == NULL)
			return $ret;

		foreach ($member->getMemberPurposes() as $memberPurpose) {
			$ret[] = '';//PurposeService::format($memberPurpose->getPurpose());
		}
		return $ret;
	}




	/**
	 * @param Member[] $members
	 * @return array
	 */
	public static function formatEntites($members) {
		$ret = [];
		foreach($members as $member)
			$ret[] = MemberService::format($member);
		return $ret;
	}

	/**
	 * @param string $password
	 * @return string
	 */
	protected static function getPasswordHash($password)
	{
		return Hash::make($password);
	}

	/**
	 * @param string $passworHash
	 * @param string $password
	 * @return bool
	 */
	protected static function verifyPasswordHash($passworHash, $password) {
		return Hash::check($password, $passworHash);
	}

	/**
	 * @return string
	 */
	private function createToken()
	{
		return bin2hex(random_bytes(44));
	}
}