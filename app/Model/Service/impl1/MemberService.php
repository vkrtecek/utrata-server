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
use App\Model\Exception\AuthenticationException;
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

	/** @var IMemberPurposeService */
	protected $memberPurposeService;

	/**
	 * MemberService constructor.
	 * @param IMemberDAO $memberDao
	 * @param ILanguageService $languageService
	 * @param ICurrencyService $currencyService
	 * @param IMemberPurposeService $memberPurposeService
	 */
	public function __construct(IMemberDAO $memberDao, ILanguageService $languageService, ICurrencyService $currencyService, IMemberPurposeService $memberPurposeService)
	{
		$this->memberDao = $memberDao;
		$this->languageService = $languageService;
		$this->currencyService = $currencyService;
		$this->memberPurposeService = $memberPurposeService;
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
	 * @throws AlreadyExistException
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
	 * @throws AlreadyExistException for e-mails
	 * @throws AuthenticationException
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
	 * @param $fb_data = {name, fname, lname, login, email, locale}
	 * @return Member
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 */
	public function interactWithFacebook($fb_data) {
		if ($member = $this->memberDao->findOne($fb_data['login'])) {
			return $this->loginByFacebook($fb_data['login']);
		}

		$inputsKeys = [ 'fname', 'lname', 'login', 'email', 'locale' ];
		foreach ($inputsKeys as $key) {
			if (!isset($fb_data[$key]) || $fb_data[$key] == '')
				throw new BadParameterException('MemberService: "' . $key . '" must be specified.');
		}

		if (!preg_match('/[1-9][0-9]* /', $fb_data['login']))
			throw new BadParameterException('MemberService: ID is not INTEGER or smaller than 1.');

		$data = [];
		$data['firstName'] = $fb_data['fname'];
		$data['lastName'] = $fb_data['lname'];
		$data['login'] = $fb_data['login'];
		$data['password'] = self::defaultPassword;
		$data['mother'] = $fb_data['email'];
		$data['me'] = $fb_data['email'];
		$data['expiration'] = (new DateTime('+ 14 days'))->format('Y-m-d H:i:s');
		$data['access'] = (new DateTime())->format('Y-m-d H:i:s');
		$data['currencyCode'] = $this->getCurrencyFromLocale($fb_data['locale'])->getCode();
		$data['languageCode'] = $this->getLanguageFromLocale($fb_data['locale'])->getCode();
		$data['facebook'] = TRUE;

		$member = new Member();
		$this->setMember($member, $data, TRUE);
		return $this->memberDao->create($member);
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
	 * @param bool $newEntity
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 * @throws AuthenticationException
	 */
	protected function setMember(Member $member, array $data, $newEntity = TRUE) {
		$dateFormat = '/^2[0-1][0-9][0-9]-[0-1][0-9]-[0-3][0-9] [0-2][0-9]:[0-5][0-9]:[0-5][0-9].[0-9]*$/';
		$emailFormat = '/^[a-zA-Z0-9,.,_,-][a-zA-Z0-9,.,_,-]*@[a-zA-Z0-9,.,_,-][a-zA-Z0-9,.,_,-]*\.[a-z]{2,5}$/';

		//povinné položky
		if ($newEntity) {
			if (!isset($data['currencyCode']) || $data['currencyCode'] == NULL)
				throw new BadRequestHttpException('MemberService: Currency must be specified.');
			if (!isset($data['languageCode']) || $data['languageCode'] == NULL)
				throw new BadRequestHttpException('MemberService: Language must be specified.');
			if (!isset($data['login']) || $data['login'] == NULL)
				throw new BadRequestHttpException('MemberService: "login" must be specified.');
			if (!isset($data['password']) || $data['password'] == NULL)
				throw new BadRequestHttpException('MemberService: "passwordHash" must be specified.');
			if (!isset($data['mother']) || $data['mother'] == NULL)
				throw new BadRequestHttpException('MemberService: "mother" must be specified.');
			if (!isset($data['me']) || $data['me'] == NULL)
				throw new BadRequestHttpException('MemberService: "me" must be specified.');
		}





		if (isset($data['currencyCode']) && $data['currencyCode']) {
			try {
				$member->setCurrency($this->currencyService->getCurrencyByColumn('code', $data['currencyCode']));
			} catch (NotFoundException $ex) {
				throw new NotFoundException('MemberService: No Currency found with given id.', 0, $ex);
			}
		}
		if (isset($data['languageCode']) && $data['languageCode'] != '') {
			try {
				/*
				 * delete all purposes which user don't use and old language
				 * add all purposes with new language and base=true
				 */
				foreach ($member->getPurposes() as $purpose)
					$this->memberPurposeService->delete($member, $purpose);

				$newLanguageCode = $data['languageCode'];
				$languagePurposes = $this->memberPurposeService->getLanguageBasePurposes($newLanguageCode);
				foreach ($languagePurposes as $purpose)
					$this->memberPurposeService->create($member, $purpose);
				$member->setLanguage($this->languageService->getLanguage($data['languageCode']));
			} catch (NotFoundException $ex) {
				throw new NotFoundException('MemberService: No language found with given code.', 0, $ex);
			}
		}
		if (isset($data['login']) && $data['login']) {
			if ($member->getLogin() != $data['login'] && !Member::uniqueLogin($data['login']))
				throw new AlreadyExistException('MemberService: This login already exists');
			$member->setLogin($data['login']);
		}
		if (isset($data['password']) && $data['password']) {
			if (!$newEntity) {
				if (!isset($data['oldPassword']) || $data['oldPassword'] == "")
					throw new BadRequestHttpException('MemberService: "oldPassword" expected');
				else if (!self::verifyPasswordHash($member->getPassword(), $data['oldPassword']))
					throw new AuthenticationException('Given oldPassword is incorrect');
			}
			$member->setPassword(self::getPasswordHash($data['password']));
		}
		if (isset($data['mother']) && $data['mother']) {
			if (!preg_match($emailFormat, $data['mother']))
				throw new BadParameterException('MemberService: mother mail in bad format');
			$member->setMotherMail($data['mother']);
		}
		if (isset($data['me']) && $data['me']) {
			if (!preg_match($emailFormat, $data['me']))
				throw new BadParameterException('MemberService: your mail in bad format');
			if ($member->getMyMail() != $data['me'] && !Member::uniqueMail($data['me']))
				throw new AlreadyExistException('MemberService: This mail already exists');
			$member->setMyMail($data['me']);
		}
		if (isset($data['notes']) && $data['notes']) {
			//deletes less and adds more
			$this->setNotes($member, $data['notes']);
		}

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
		if (preg_match('/cs_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'CZK');
		if (preg_match('/en_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'EUR');
		if (preg_match('/sk_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'EUR');

		return $currency;
	}

	/**
	 * @param string $locale
	 * @return Language|null
	 */
	protected function getLanguageFromLocale($locale) {
		$language = NULL;
		if (preg_match('/cs_.*/', $locale)) $language = $this->languageService->getLanguage('CZK');
		if (preg_match('/en_.*/', $locale)) $language = $this->languageService->getLanguage('ENG');
		if (preg_match('/sk_.*/', $locale)) $language = $this->languageService->getLanguage('SVK');

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
		return $this->memberDao->update($member);
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
		$ret['facebook'] = $member->isFacebook();
		$ret['languageCode'] = $member->getLanguage()->getCode();
		$ret['currencyCode'] = $member->getCurrency()->getCode();
		$ret['lastLogged'] = $member->getAccess()->format('Y-m-d H:i:s');
		$ret['notes'] = MemberService::getFormattedPurposes($member);

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
			$ret[] = PurposeService::format($memberPurpose->getPurpose());
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
	 * @param string $passwordHash
	 * @param string $password
	 * @return bool
	 */
	protected static function verifyPasswordHash($passwordHash, $password) {
		return Hash::check($password, $passwordHash);
	}

	/**
	 * @return string
	 */
	private function createToken()
	{
		return bin2hex(random_bytes(44));
	}


	/**
	 * @param Member $member
	 * @param array $notes
	 * @return void
	 */
	private function setNotes(Member $member, $notes) {

		$originNoteIds = [];
		foreach ($member->getPurposes() as $purpose) {
			$originNoteIds[] = $purpose->getId();
		}

		$noteIds = [];
		$tmp = [];
		foreach ($notes as $note) {
			if (!isset($note['id']))
				throw new BadRequestHttpException("MemberService: Note hasn't id");
			$noteIds[] = $note['id'];
			$tmp[] = $this->memberPurposeService->getPurpose($note['id']);
		}

		$more = array_diff($noteIds, $originNoteIds);
		$moreNotes = [];
		foreach ($more as $id)
			$moreNotes[] = $this->memberPurposeService->getPurpose($id);

		$less = array_diff($originNoteIds, $noteIds);
		$lessNotes = [];
		foreach ($less as $id)
			$lessNotes[] = $this->memberPurposeService->getPurpose($id);

		foreach ($moreNotes as $note) {
			$this->memberPurposeService->create($member, $note);
		}

		foreach ($lessNotes as $note) {
			$this->memberPurposeService->delete($member, $note);
		}
	}
}