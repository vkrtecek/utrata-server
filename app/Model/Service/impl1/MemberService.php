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
use App\Model\Exception\BadRequestException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\SecurityException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use DateTime;

class MemberService implements IMemberService
{
	const TOKEN_STRLEN = 44;
	const defaultPassword = 'Facebook Password';
	const defaultEmail = 'someFacebook@example.com';

	/** @var IMemberDAO */
	protected $memberDao;

	/** @var ILanguageService */
	protected $languageService;

	/** @var ICurrencyService */
	protected $currencyService;

	/** @var IPurposeService */
	protected $purposeService;

	/** @var IMemberPurposeService */
	protected $memberPurposeService;

	/** @var ITranslationService */
	protected $translationService;

	/**
	 * MemberService constructor.
	 * @param IMemberDAO $memberDao
	 * @param ILanguageService $languageService
	 * @param ICurrencyService $currencyService
	 * @param IPurposeService $purposeService
	 * @param IMemberPurposeService $memberPurposeService
	 * @param ITranslationService $translationService
	 */
	public function __construct(
		IMemberDAO $memberDao,
		ILanguageService $languageService,
		ICurrencyService $currencyService,
		IPurposeService $purposeService,
		IMemberPurposeService $memberPurposeService,
		ITranslationService $translationService
	) {
		$this->memberDao = $memberDao;
		$this->languageService = $languageService;
		$this->currencyService = $currencyService;
		$this->purposeService = $purposeService;
		$this->memberPurposeService = $memberPurposeService;
		$this->translationService = $translationService;
	}

	/** @inheritdoc */
	public function getMembers(): array {
		$members = $this->memberDao->findAll();
		if (count($members) == 0)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Member']);
		return $members;
	}


    /** @inheritdoc */
    public function getMember(string $login): Member {
		$member = $this->memberDao->findOne($login);
		if ($member == NULL)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Member']);
		return $member;
	}

    /** @inheritdoc */
    public function getByToken(string $token): Member {
		$member = $this->memberDao->findOneByColumn('remember_token', $token);
		if ($member == NULL)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Member']);
		return $member;
	}

    /** @inheritdoc */
    public function createMember(array $data): Member {
		$member = new Member();
		if (!isset($data['login']))
			throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'login']);
		try {
			$this->getMember($data['login']);
			throw (new AlreadyExistException('Exception.AlreadyExists', ':entity with this :parameter already exists'))->setBind(['entity' => 'Member', 'parameter' => 'login']);
		} catch (NotFoundException $ex) {
			$this->setMember($member, $data);
			$member->setToken($this->createToken());
			$member = $this->memberDao->create($member);
			$this->createStartingPurposes($member);
			return $member;
		}
	}

    /** @inheritdoc */
    public function updateMember(string $login, array $data): Member {
		try {
			$member = $this->getMember($login);
		} catch (NotFoundException $ex) {
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Member']);
		}
		$this->setMember($member, $data, FALSE);
		return $this->memberDao->update($member);
	}

    /** @inheritdoc */
    public function deleteMember(string $login) {
        //test if member exists
        $member = $this->getMember($login);
        $memberPurposes = $this->memberPurposeService->getMemberPurposes($member);
        foreach ($memberPurposes as $memberPurpose)
            $this->memberPurposeService->delete($member, $memberPurpose->getPurpose());
        return $this->memberDao->delete($member);
	}

    /** @inheritdoc */
    public function interactWithFacebook(array $fb_data): Member {
		if ($member = $this->memberDao->findOne($fb_data['login'])) {
			return $this->loginByFacebook($fb_data['login']);
		}
		$inputsKeys = [ 'fname', 'lname', 'login', /*'email',*/ 'locale' ];
		foreach ($inputsKeys as $key) {
			if (!isset($fb_data[$key]) || $fb_data[$key] == '')
				throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => $key]);
		}

		if (!preg_match('/[1-9][0-9]*/', $fb_data['login']))
			throw new BadParameterException('Exception.BadParameter.SmallerThan1', 'Identifier smaller than 1');

		$data = [];
		$data['firstName'] = $fb_data['fname'];
		$data['lastName'] = $fb_data['lname'];
		$data['login'] = $fb_data['login'];
		$data['password'] = self::defaultPassword;
		$data['me'] = self::defaultEmail; //$fb_data['email'];
		$data['expiration'] = (new DateTime('+ 14 days'))->format('Y-m-d H:i:s');
		$data['access'] = (new DateTime())->format('Y-m-d H:i:s');
		$data['currencyCode'] = $this->getCurrencyFromLocale($fb_data['locale'])->getCode();
		$data['languageCode'] = $this->getLanguageFromLocale($fb_data['locale'])->getCode();
		$data['facebook'] = TRUE;

		//create new member
		$member = new Member();
		$member->setFacebook(TRUE);
		$this->setMember($member, $data, TRUE);
		$member->setToken($this->createToken());
		$member->setLogged(1);
		$member = $this->memberDao->create($member);
		$this->createStartingPurposes($member);
		return $member;
	}

    /** @inheritdoc */
    public function logout(Member $member): Member {
		$logged = $member->getLogged();
		if (!--$logged) {
			$member->setExpiration(new \DateTime());
			$member->setToken('');
		}
		$member->setLogged($logged);
		return $this->memberDao->update($member);
	}

    /** @inheritdoc */
    public function getMemberByColumn(string $column, string $value): Member {
        $columns = [ 'login', 'token', 'MemberID', 'myMail' ];
        if (!in_array($column, $columns))
            throw (new BadParameterException('Exception.ColumnNotAllowed', 'This column (:column) not allowed.'))->setBind(['column' => $column]);
        $member = $this->memberDao->findOneByColumn($column, $value);
        if ($member == NULL)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Member']);
        return $member;
    }

    /** @inheritdoc */
    public function login(string $login, string $password): Member {
        try {
            $member = $this->getMemberByColumn('login', $login);
            if (!self::verifyPasswordHash($member->getPassword(), $password))
                throw new SecurityException('Exception.Security.BadPassword', 'Bad password');
            $logged = $member->getLogged();
            if (!$logged || $member->getExpiration() < new DateTime()) {
                $token = $this->createToken();
                $member->setToken($token);
                $member->setLogged(1);
            } else {
                $member->setLogged($logged + 1);
            }
            $member->setAccess(new DateTime());
            $member->setExpiration(new DateTime('+ 1 day'));
            $this->memberDao->update($member);
            return $member;
        } catch (NotFoundException $ex) {
            throw (new SecurityException($ex->getMessage(), $ex->getDefault()))->setBind($ex->getBinds());
        }
    }

    /** @inheritdoc */
    public function loginByFacebook(string $login): Member {
        $member = $this->getMemberByColumn('login', $login);
        $logged = $member->getLogged();
        if (!$logged || $member->getExpiration() < new DateTime()) {
            $token = $this->createToken();
            $member->setToken($token);
            $member->setLogged(1);
        } else {
            $member->setLogged($logged + 1);
        }
        $member->setAccess(new DateTime());
        $member->setExpiration(new DateTime('+ 14 days'));
        return $this->memberDao->update($member);
    }

    /** @inheritdoc */
    public function format(Member $member): array {
        $ret = [];

        $ret['id'] = $member->getId();
        $ret['firstName'] = $member->getFirstName();
        $ret['lastName'] = $member->getLastName();
        $ret['login'] = $member->getLogin();
        $ret['sendMonthly'] = $member->shouldSendMonthly();
        $ret['sendByOne'] = $member->shouldSendByOne();
        $ret['me'] = $member->getMyMail();
        $ret['token'] = $member->getToken();
        $ret['facebook'] = $member->isFacebook();
        $ret['languageCode'] = $member->getLanguage()->getCode();
        $ret['currencyCode'] = $member->getCurrency()->getCode();
        $ret['lastLogged'] = $member->getAccess()->format('Y-m-d H:i:s');
        $ret['notes'] = $this->getFormattedPurposes($member);
        $ret['external'] = $member->isExternal();

        return $ret;
    }


    /** @inheritdoc */
    public function formatEntities(array $members): array {
        $ret = [];
        foreach($members as $member)
            $ret[] = $this->format($member);
        return $ret;
    }






	/**
	 * @param Member $member
	 * @param array $data
	 * @param bool $newEntity
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws BadRequestException
	 * @throws AlreadyExistException
	 * @throws AuthenticationException
	 */
	protected function setMember(Member & $member, array $data, bool $newEntity = TRUE) {
		$dateFormat = '/^2[0-1][0-9][0-9]-[0-1][0-9]-[0-3][0-9] [0-2][0-9]:[0-5][0-9]:[0-5][0-9].{0,1}[0-9]*$/';
		$emailFormat = '/^[a-zA-Z0-9,.,_,-][a-zA-Z0-9,.,_,-]*@[a-zA-Z0-9,.,_,-][a-zA-Z0-9,.,_,-]*\.[a-z]{2,5}$/';
		$changedLanguage = FALSE;

		//povinné položky
		if ($newEntity) {
			if (!isset($data['currencyCode']) || $data['currencyCode'] == NULL)
				throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Currency']);
			if (!isset($data['languageCode']) || $data['languageCode'] == NULL)
				throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Language']);
			if (!isset($data['login']) || $data['login'] == NULL)
				throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'login']);
			if (!isset($data['password']) || $data['password'] == NULL)
				throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'password']);
			if (!isset($data['me']) || $data['me'] == NULL)
				throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'me']);

			$member->setToken($this->createToken());
			if (isset($data['first_name'])) $member->setFirstName($data['first_name']);
			if (isset($data['last_name'])) $member->setLastName($data['last_name']);
		}





		if (isset($data['currencyCode']) && $data['currencyCode']) {
            $member->setCurrency($this->currencyService->getCurrencyByColumn('code', $data['currencyCode']));
		}
		if (isset($data['languageCode']) && $data['languageCode'] != '') {
            if (!$newEntity && $data['languageCode'] != $member->getLanguage()->getCode()) {
                /*
                 * delete all purposes of old language which user don't use
                 * add all purposes with new language and base=true
                 */
                foreach ($this->memberPurposeService->getMemberPurposes($member) as $memberPurpose)
                    $this->memberPurposeService->delete($member, $memberPurpose->getPurpose());

                if (isset($data['notes']) && $data['notes'] && count($data['notes'])) {
                    //deletes less and adds more
                    $this->setNotes($member, $data['notes']);
                } else {
                    $newLanguageCode = $data['languageCode'];
                    $languagePurposes = $this->purposeService->getLanguageBasePurposes($newLanguageCode);
                    foreach ($languagePurposes as $purpose) {
                        $this->memberPurposeService->create($member, $purpose);
                    }
                }
                $changedLanguage = TRUE;
            }
            $newLanguage = $this->languageService->getLanguage($data['languageCode']);
            $member->setLanguage($newLanguage);
		}
		if (isset($data['login']) && $data['login']) {
			if ($member->getLogin() != $data['login'] && !$this->uniqueLogin($data['login']))
				throw (new AlreadyExistException('Exception.AlreadyExists', ':entity with this :parameter already exists'))->setBind(['entity' => 'Member', 'parameter' => 'login']);
			$member->setLogin($data['login']);
		}
		if (isset($data['password']) && $data['password']) {
			if (!$newEntity) {
				if (!isset($data['oldPassword']) || $data['oldPassword'] == "")
					throw (new BadRequestException('Settings.Form.Error.OldPasswordExpected', '"oldPassword" expected'));
				else if (!self::verifyPasswordHash($member->getPassword(), $data['oldPassword'])) {
					throw (new AuthenticationException('Exception.Parameter.Incorrect', 'Given :parameter is incorrect'))->setBind(['parameter' => 'oldPassword']);
				}
			}
			$member->setPassword(self::getPasswordHash($data['password']));
		}
		if (isset($data['me']) && $data['me']) {
			if (!preg_match($emailFormat, $data['me']))
				throw (new BadParameterException('Exception.Parameter.BadFormat', ':parameter in bad format'))->setBind(['parameter' => 'your mail']);
			if ($member->getMyMail() != $data['me'] && !$member->isExternal() && !$this->uniqueMail($data['me']))
                throw (new AlreadyExistException('Exception.AlreadyExists', ':entity with this :parameter already exists'))->setBind(['entity' => 'Member', 'parameter' => 'mail']);
			$member->setMyMail($data['me']);
		}
		if (isset($data['notes']) && $data['notes'] && !$changedLanguage) {
			//deletes less and adds more
			$this->setNotes($member, $data['notes']);
		}

		if (isset($data['sendMonthly'])) $member->setSendMonthly($data['sendMonthly']);
		if (isset($data['sendByOne'])) $member->setSendByOne($data['sendByOne']);
		if (isset($data['admin'])) $member->setAdmin($data['admin']);
		if (isset($data['logged'])) $member->setLogged($data['logged']);
		if (isset($data['access'])) {
			if (!preg_match($dateFormat, $data['access']))
                throw (new BadRequestException('Exception.Parameter.BadFormat', ':parameter in bad format'))->setBind(['parameter' => 'access']);
			$member->setAccess(new DateTime($data['access']));
		}
		if (isset($data['facebook'])) $member->setFacebook($data['facebook']);
		if (isset($data['expiration'])) {
			if (!($data['expiration'] instanceof \DateTime) && !preg_match($dateFormat, $data['expiration']))
				throw (new BadRequestException('Exception.Parameter.BadFormat', ':parameter in bad format'))->setBind(['parameter' => 'expiration']);
			$member->setExpiration(new DateTime($data['expiration']));
		}
		if (isset($data['firstName'])) $member->setFirstName($data['firstName']);
		if (isset($data['lastName'])) $member->setLastName($data['lastName']);

	}

	/**
	 * @param $locale
	 * @return Currency
     * @throws NotFoundException
	 */
	protected function getCurrencyFromLocale(string $locale): Currency {
		$currency = NULL;
		if (preg_match('/cs_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'CZK');
		else if (preg_match('/en_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'EUR');
		else if (preg_match('/sk_.*/', $locale)) $currency = $this->currencyService->getCurrencyByColumn('code', 'EUR');
		else $currency = $this->currencyService->getCurrencyByColumn('code', 'EUR');  //default

		return $currency;
	}

	/**
	 * @param string $locale
	 * @return Language
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	protected function getLanguageFromLocale(string $locale): Language {
		$language = NULL;
		if (preg_match('/cs_.*/', $locale)) $language = $this->languageService->getLanguage('CZK');
		else if (preg_match('/en_.*/', $locale)) $language = $this->languageService->getLanguage('ENG');
		else if (preg_match('/sk_.*/', $locale)) $language = $this->languageService->getLanguage('SVK');
		else $language = $this->languageService->getLanguage('ENG'); //default

		return $language;
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

	/** @return string */
	protected function createToken() {
		return bin2hex(random_bytes(self::TOKEN_STRLEN));
	}

    /**
     * @param string $login
     * @return bool
     */
    protected function uniqueLogin(string $login): bool {
        return $this->memberDao->findOneByColumn('login', $login) !== null;
    }

    /**
     * @param string $mail
     * @return bool
     */
    protected function uniqueMail(string $mail): bool {
        return $this->memberDao->findOneByColumn('myMail', $mail) !== null;
    }

    /**
     * @param Member $member
     * @return array
     */
    private function getFormattedPurposes(Member $member) {
        $ret = [];
        if (!count($items = $this->memberPurposeService->getMemberPurposes($member)))
            return $ret;

        foreach ($items as $memberPurpose) {
            $ret[] = $this->purposeService->format($memberPurpose->getPurpose(), $member);
        }
        return $ret;
    }


	/**
	 * @param Member $member
	 * @param array $notes
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws BadRequestException
	 */
	private function setNotes(Member $member, array $notes) {
		$originNoteIds = [];
		foreach ($this->memberPurposeService->getMemberPurposes($member) as $memberPurpose) {
			$originNoteIds[] = $memberPurpose->getPurpose()->getId();
		}

		$noteIds = [];
		$tmp = [];
		foreach ($notes as $note) {
			if (!isset($note['id']))
				throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Note("id")']);
			$noteIds[] = $note['id'];
			$tmp[] = $this->purposeService->getPurpose($note['id']);
		}


		$more = array_diff($noteIds, $originNoteIds);
		$moreNotes = [];
		foreach ($more as $id)
			$moreNotes[] = $this->purposeService->getPurpose($id);

		$less = array_diff($originNoteIds, $noteIds);
		$lessNotes = [];
		foreach ($less as $id)
			$lessNotes[] = $this->purposeService->getPurpose($id);

		foreach ($moreNotes as $note) {
			$this->memberPurposeService->create($member, $note);
		}

		foreach ($lessNotes as $note) {
			$this->memberPurposeService->delete($member, $note);
		}
	}


	/**
	 * creates basic purposes in member's language
	 * @param Member $member
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	private function createStartingPurposes(Member $member) {
		$basicPurposes = $this->purposeService->getLanguageBasePurposes($member->getLanguage()->getCode());
		foreach ($basicPurposes as $purpose) {
			$this->memberPurposeService->create($member, $purpose);
		}
	}
}
