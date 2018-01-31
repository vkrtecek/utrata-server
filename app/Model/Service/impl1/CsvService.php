<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:53
 */

namespace App\Model\Service;


use App\Model\Dao\IPurposeDAO;
use App\Model\Dao\IWalletDAO;
use App\Model\Entity\CheckState;
use App\Model\Entity\File;
use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Entity\Wallet;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\EOFException;
use App\Model\Exception\FileParseException;
use App\Model\Exception\NotFoundException;

/**
 * Class CsvService converts Member's data into csv file
 * Structure:
 * 		csv Member
 * 		number of purposes
 * 		csv Purposes
 * 		number of wallets
 * 		csv Wallets
 * 		number of items
 * 		csv Items
 * 		number of check_tates
 * 		csv CheckStates
 * @package App\Model\Service
 */
class CsvService implements IFileService
{
	const MEMBER_FIELDS = 12;
	const PURPOSE_FIELDS = 6;
	const WALLET_FIELDS = 3;
	const ITEM_FIELDS = 14;
	const CHECK_STATE_FIELDS = 3;

	/** @var IPurposeDAO */
	protected $purposeDao;

	/** @var IWalletDAO */
	protected $walletDao;

	/** @var IWalletService */
	protected $walletService;

	/** @var ICheckStateService */
	protected $checkStateService;

	/** @var IPurposeService */
	protected $purposeService;

	/** @var ILanguageService */
	protected $languageService;

	/** @var ICurrencyService */
	protected $currencyService;

	/** @var IMemberService */
	protected $memberService;

	/** @var IItemService */
	protected $itemService;

	/**
	 * CsvService constructor.
	 * @param IPurposeDAO $purposeDAO
	 * @param IWalletDAO $walletDAO
	 * @param IWalletService $walletService
	 * @param ICheckStateService $checkStateService
	 * @param IPurposeService $purposeService
	 * @param ILanguageService $languageService
	 * @param ICurrencyService $currencyService
	 * @param IMemberService $memberService
	 * @param IItemService $itemService
	 */
	public function __construct(
		IPurposeDAO $purposeDAO,
		IWalletDAO $walletDAO,
		IWalletService $walletService,
		ICheckStateService $checkStateService,
		IPurposeService $purposeService,
		ILanguageService $languageService,
		ICurrencyService $currencyService,
		IMemberService $memberService,
		IItemService $itemService
	) {
		$this->purposeDao = $purposeDAO;
		$this->walletDao = $walletDAO;
		$this->walletService = $walletService;
		$this->checkStateService = $checkStateService;
		$this->purposeService = $purposeService;
		$this->languageService = $languageService;
		$this->currencyService = $currencyService;
		$this->memberService = $memberService;
		$this->itemService = $itemService;
	}

	/**
	 * @param Member $member
	 * @return string
	 */
	public function getBackup(Member $member) {
		$content = new File();
		$content->appendLine(self::formatMember($member));

		//purposes
		$memberPurposes = $member->getMemberPurposes();
		$content->appendLine(count($memberPurposes));
		foreach ($memberPurposes as $memberPurpose) {
			$purpose = $memberPurpose->getPurpose();
			$content->appendLine(self::formatPurpose($purpose));
		}

		//wallets
		$wallets = $member->getWallets();
		$content->appendLine(count($wallets));
		foreach ($wallets as $wallet)
			$content->appendLine(self::formatWallet($wallet));

		//items
		$items = $member->getItems();
		$content->appendLine(count($items));
		foreach ($items as $item)
			$content->appendLine(self::formatItem($item));


		//checksates
		$checkStates = $member->getCheckStates();
		$content->appendLine(count($checkStates));
		foreach ($checkStates as $checkState)
			$content->appendLine(self::formatCheckState($checkState));


		return $content->getContent();
	}

	/**
	 * @param Member $member
	 * @param string $content
	 * @return boolean
	 * @throws FileParseException
	 * @throws EOFException
	 */
	public function storeBackup(Member $member, $content) {
		$file = new File($content);
		$member = $this->getMember($file->getLine());

		//purposes
		$purposes = [];
		$purposeCnt = $file->getLine();
		if ((string)((int)$purposeCnt) != $purposeCnt)
			throw new FileParseException('Parse: Purpose count number not integer');
		for ($i = 0; $i < $purposeCnt; $i++) {
			try {
				$purposes[] = $this->getPurpose($file->getLine());
			} catch (FileParseException $ex) {
				throw new FileParseException(($i+1) . 'nt Purpose: ' . $ex->getMessage(), 0, $ex);
			}
		}

		//wallets
		$wallets = [];
		$walletsCnt = $file->getLine();
		if ((string)((int)$walletsCnt) != $walletsCnt)
			throw new FileParseException('Parse: Wallet count number not integer');
		for ($i = 0; $i < $walletsCnt; $i++) {
			try {
				$wallets[] = $this->getWallet($file->getLine(), $member);
			} catch (FileParseException $ex) {
				throw new FileParseException(($i+1) . 'nt Wallet: ' . $ex->getMessage(), 0, $ex);
			}
		}

		return TRUE;
	}











	/**
	 * converted Member into csv
	 * @param Member $member
	 * @return string
	 */
	private static function formatMember(Member $member) {
		return $member->getFirstName() . ';' .
			$member->getLastName() . ';' .
			$member->getLogin() . ';' .
			$member->getPassword() . ';' .
			$member->shouldSendMonthly() . ';' .
			$member->shouldSendByOne() . ';' .
			$member->getMotherMail() . ';' .
			$member->getMyMail() . ';' .
			$member->isFacebook() . ';' .
			$member->getAccess()->format('Y-m-d H:i:s') . ';' .
			$member->getLanguage()->getCode() . ';' .
			$member->getCurrency()->getId();
	}

	/**
	 * converted Purpose into csv
	 * @param Purpose $purpose
	 * @return string
	 */
	private static function formatPurpose(Purpose $purpose) {
		return $purpose->getId() . ';' .
			$purpose->getCode() . ';' .
			$purpose->getValue() . ';' .
			$purpose->isBase() . ';' .
			$purpose->getLanguage()->getCode() . ';' .
			($purpose->getCreator() ? $purpose->getCreator()->getLogin() : NULL);
	}

	/**
	 * converted Wallet into csv
	 * @param Wallet $wallet
	 * @return string
	 */
	private static function formatWallet(Wallet $wallet) {
		return $wallet->getId() . ';' .
			$wallet->getName() . ';' .
			$wallet->getCreated()->format('Y-m-d H:i:s');
	}

	/**
	 * converted Item into csv
	 * @param Item $item
	 * @return string
	 */
	private static function formatItem(Item $item) {
		return $item->getName() . ';' .
			$item->getDescription() . ';' .
			$item->getPrice() . ';' .
			$item->getCourse() . ';' .
			$item->getDate()->format('Y-m-d H:i:s') . ';' .
			$item->getCreated()->format('Y-m-d H:i:s') . ';' .
			$item->getType() . ';' .
			$item->isActive() . ';' .
			$item->isIncome() . ';' .
			$item->isVyber() . ';' .
			$item->isOdepsat() . ';' .
			($item->getNote() ? $item->getNote()->getId() : NULL) . ';' .
			$item->getCurrency()->getCode() . ';' .
			$item->getWallet()->getId();
	}

	/**
	 * converted CheckSate into csv
	 * @param CheckState $checkState
	 * @return string
	 */
	private static function formatCheckState(CheckState $checkState) {
		return $checkState->getType() . ';' .
			$checkState->getChecked()->format('Y-m-d H:i:s') . ';' .
			$checkState->getValue();
	}






















	/**
	 * converted csv into Member
	 * @param string $string
	 * @return Member
	 * @throws FileParseException
	 */
	private function getMember($string)
	{
		if (count(explode(';', $string)) != self::MEMBER_FIELDS)
			throw new FileParseException('ParseMember: ' . self::MEMBER_FIELDS . ' fields expected, ' . count(explode(';', $string)) . ' given.');
		list($fName,
			$lName,
			$login,
			$passwd,
			$monthly,
			$byOne,
			$mother,
			$me,
			$fb,
			$access,
			$_language,
			$_currency) = explode(';', $string);

		try {
			$language = $this->languageService->getLanguage($_language);
		} catch (\Exception $e) {
			throw new FileParseException('ParseMember: LanguageCode not found');
		}
		try {
			$currency = $this->currencyService->getCurrency($_currency);
		} catch (\Exception $e) {
			throw new FileParseException('ParseMember: Bad currencyId');
		}

		$_member = new Member();
		$_member->setFirstName($fName)->setLastName($lName)->setLogin($login)
			->setPassword($passwd)->setSendMonthly($monthly)->setSendByOne($byOne)
			->setMotherMail($mother)->setMyMail($me)->setFacebook($fb)->setAccess(new \DateTime($access))
			->setLanguage($language)->setCurrency($currency);

		try {
			$member = $this->memberService->getMember($login);
		} catch (\Exception $ex) {
			throw new FileParseException('ParseMember: member not found.');
		}
		if (
			$member->getFirstName() != $_member->getFirstName()
			|| $member->getLastName() != $_member->getLastName()
			|| $member->getPassword() != $_member->getPassword()
			|| $member->shouldSendMonthly() != $_member->shouldSendMonthly()
			|| $member->shouldSendByOne() != $_member->shouldSendByOne()
			|| $member->getMotherMail() != $_member->getMotherMail()
			|| $member->getMyMail() != $_member->getMyMail()
			|| $member->isFacebook() != $_member->isFacebook()
			|| $member->getLanguage()->getCode() != $_member->getLanguage()->getCode()
			|| $member->getCurrency() != $_member->getCurrency()
		) throw new FileParseException('ParseMember: member not found');

		return $member;
	}


	/**
	 * converted csv into Purpose
	 * @param string $string
	 * @return Purpose
	 * @throws FileParseException
	 */
	private function getPurpose($string) {
		if (count(explode(';', $string)) != self::PURPOSE_FIELDS)
			throw new FileParseException(self::PURPOSE_FIELDS . ' fields expected, ' . count(explode(';', $string)) . ' given.');
		list($id, $code, $val, $base, $_language, $_creator) = explode(';', $string);

		try {
			$purpose = $this->purposeService->getPurpose($id);
		} catch (NotFoundException $e) {
			//new purpose
			try {
				$language = $this->languageService->getLanguage($_language);
				$creator = $this->memberService->getMember($_creator);
			} catch (\Exception $e) {
				throw new FileParseException('Bad LanguageCode or CreatrorID');
			}
			if ($code == ""
				|| $val == ""
			) throw new FileParseException('Some field is empty');

			$base = $base == "1" || $base == "0" ? $base : false;
			$purpose = new Purpose();
			$purpose->setCode($code)->setValue($val)->setBase($base)->setLanguage($language)->setCreator($creator);
			$purpose = $this->purposeDao->create($purpose);
		} catch (\Exception $ex) {
			throw new FileParseException('Bad PurposeID');
		}
		return $purpose;
	}


	/**
	 * converted csv into Wallet
	 * @param string $string
	 * @param Member $member
	 * @return Wallet
	 * @throws FileParseException
	 */
	private function getWallet($string, Member $member) {
		if (count(explode(';', $string)) != self::WALLET_FIELDS)
			throw new FileParseException(self::WALLET_FIELDS . ' fields expected, ' . count(explode(';', $string)) . ' given.');
		list($id, $name, $created) = explode(';', $string);
		try {
			$wallet = $this->walletService->getWallet($id, $member);
		} catch (BadParameterException $e) {
			throw new FileParseException('WalletID not INTEGER or smaller than 1.');
		} catch (\Exception $e) {
			if ($name == "")
				throw new FileParseException('Empty name');

			$wallet = new Wallet();
			$wallet->setName($name);
			$wallet->setMember($member);
			$wallet = $this->walletDao->create($wallet);
		}
		return $wallet;
	}
}