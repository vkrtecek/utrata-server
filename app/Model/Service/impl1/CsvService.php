<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:53
 */

namespace App\Model\Service;


use App\Model\Dao\ICheckStateDAO;
use App\Model\Dao\IItemDAO;
use App\Model\Dao\IMemberDAO;
use App\Model\Dao\IPurposeDAO;
use App\Model\Dao\IWalletDAO;
use App\Model\Entity\CheckState;
use App\Model\Entity\File;
use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
use App\Model\Exception\AuthenticationException;
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
 * 		number of check_states
 * 		csv CheckStates
 * @package App\Model\Service
 */
class CsvService implements IFileService
{
	//avoid to have only one field
	// couse it could be confused with line describing number of following rows
	// in bad format of CSV file
	const MEMBER_FIELDS = 11;
	const PURPOSE_FIELDS = 6;
	const WALLET_FIELDS = 2;
	const ITEM_FIELDS = 15;
	const CHECK_STATE_FIELDS = 5;

	/** @var IMemberDAO */
	protected $memberDao;

	/** @var IPurposeDAO */
	protected $purposeDao;

	/** @var IWalletDAO */
	protected $walletDao;

	/** @var IItemDAO */
	protected $itemDao;

	/** @var ICheckStateDAO */
	protected $checkStateDao;

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
	 * @param IMemberDAO $memberDAO
	 * @param IPurposeDAO $purposeDAO
	 * @param IWalletDAO $walletDAO
	 * @param IItemDAO $itemDAO
	 * @param ICheckStateDAO $checkStateDAO
	 * @param IWalletService $walletService
	 * @param ICheckStateService $checkStateService
	 * @param IPurposeService $purposeService
	 * @param ILanguageService $languageService
	 * @param ICurrencyService $currencyService
	 * @param IMemberService $memberService
	 * @param IItemService $itemService
	 */
	public function __construct(
		IMemberDAO $memberDAO,
		IPurposeDAO $purposeDAO,
		IWalletDAO $walletDAO,
		IItemDAO $itemDAO,
		ICheckStateDAO $checkStateDAO,
		IWalletService $walletService,
		ICheckStateService $checkStateService,
		IPurposeService $purposeService,
		ILanguageService $languageService,
		ICurrencyService $currencyService,
		IMemberService $memberService,
		IItemService $itemService
	) {
		$this->memberDao = $memberDAO;
		$this->purposeDao = $purposeDAO;
		$this->walletDao = $walletDAO;
		$this->itemDao = $itemDAO;
		$this->checkStateDao = $checkStateDAO;
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
		$memberPurposes = $this->memberDao->getMemberPurposes($member);
		$content->appendLine(count($memberPurposes));
		foreach ($memberPurposes as $memberPurpose) {
			$purpose = $memberPurpose->getPurpose();
			$content->appendLine(self::formatPurpose($purpose));
		}

		//wallets
		$wallets = $this->memberDao->getWallets($member);
		$content->appendLine(count($wallets));
		foreach ($wallets as $wallet)
			$content->appendLine(self::formatWallet($wallet));

		//items
		$items = $this->memberDao->getItems($member);
		$content->appendLine(count($items));
		foreach ($items as $item)
			$content->appendLine(self::formatItem($item));


		//checksates
		$checkStates = [];
		foreach ($wallets as $wallet) {
			foreach ($this->walletDao->getCheckStates($wallet) as $checkState) {
				$checkStates[] = $checkState;
			}
		}
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
		if (!ctype_digit($purposeCnt))
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
		if (!ctype_digit($walletsCnt))
			throw new FileParseException('Parse: Wallet count number not integer');
		for ($i = 0; $i < $walletsCnt; $i++) {
			try {
				$wallets[] = $this->getWallet($file->getLine(), $member);
			} catch (FileParseException $ex) {
				throw new FileParseException(($i+1) . 'nt Wallet: ' . $ex->getMessage(), 0, $ex);
			}
		}

		//items
		$items = [];
		$itemsCnt = $file->getLine();
		if (!ctype_digit($itemsCnt))
			throw new FileParseException('Parse: Item count number not integer');
		for ($i = 0; $i < $itemsCnt; $i++) {
			try {
				$items[] = $this->getItem($file->getLine(), $member);
			} catch (FileParseException $ex) {
				throw new FileParseException(($i+1) . 'nt Item: ' . $ex->getMessage(), 0, $ex);
			}
		}


		//checkstates
		$checkStates = [];
		$checkStatesCnt = $file->getLine();
		if (!ctype_digit($checkStatesCnt))
			throw new FileParseException('Parse: CheckState count number not integer');
		if ($checkStatesCnt != $walletsCnt * ItemType::TYPES)
			throw new FileParseException('Parse: CheckState count expected: ' . ($walletsCnt * ItemType::TYPES) . ', got ' . $checkStatesCnt);
		for ($i = 0; $i < $checkStatesCnt; $i++) {
			try {
				$checkStates[] = $this->getCheckState($file->getLine(), $wallets[(int)($i/2)]);
			} catch (FileParseException $ex) {
				throw new FileParseException(($i+1) . 'nt CheckState: ' . $ex->getMessage(), 0, $ex);
			}
		}

		return TRUE;
	}





















	/**
	 * convert Member into csv
	 * @param Member $member
	 * @return string
	 */
	private static function formatMember(Member $member) {
		return $member->getFirstName() . ';' .
			$member->getLastName() . ';' .
			$member->getLogin() . ';' .
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
	 * convert Purpose into csv
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
	 * convert Wallet into csv
	 * @param Wallet $wallet
	 * @return string
	 */
	private static function formatWallet(Wallet $wallet) {
		return $wallet->getId() . ';' .
			$wallet->getName();
	}

	/**
	 * convert Item into csv
	 * @param Item $item
	 * @return string
	 */
	private static function formatItem(Item $item) {
		return $item->getId() . ';' .
			$item->getName() . ';' .
			$item->getDescription() . ';' .
			$item->getPrice() . ';' .
			$item->getCourse() . ';' .
			$item->getDate()->format('Y-m-d H:i:s') . ';' .
			$item->getCreated()->format('Y-m-d H:i:s') . ';' .
			$item->getType() . ';' .
			($item->isActive() ? 1 : 0) . ';' .
			($item->isIncome() ? 1 : 0) . ';' .
			($item->isVyber() ? 1 : 0) . ';' .
			($item->isOdepsat() ? 1 : 0) . ';' .
			($item->getNote() ? $item->getNote()->getId() : NULL) . ';' .
			$item->getCurrency()->getCode() . ';' .
			$item->getWallet()->getId();
	}

	/**
	 * convert CheckSate into csv
	 * @param CheckState $checkState
	 * @return string
	 */
	private static function formatCheckState(CheckState $checkState) {
		return $checkState->getId() . ';' .
			$checkState->getWallet()->getId() . ';' .
			$checkState->getType() . ';' .
			$checkState->getChecked()->format('Y-m-d H:i:s') . ';' .
			$checkState->getValue();
	}



























	/**
	 * convert csv into Member
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
			->setSendMonthly($monthly)->setSendByOne($byOne)
			->setMotherMail($mother)->setMyMail($me)->setFacebook($fb)->setAccess(new \DateTime($access))
			->setLanguage($language)->setCurrency($currency);

		try {
			$member = $this->memberService->getMember($login);
		} catch (\Exception $ex) {
			throw new FileParseException('ParseMember: member not found.');
		}

		return $member;
	}


	/**
	 * convert csv into Purpose
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
	 * convert csv into Wallet
	 * @param string $string
	 * @param Member $member
	 * @return Wallet
	 * @throws FileParseException
	 */
	private function getWallet($string, Member $member) {
		if (count(explode(';', $string)) != self::WALLET_FIELDS)
			throw new FileParseException(self::WALLET_FIELDS . ' fields expected, ' . count(explode(';', $string)) . ' given.');
		list($id, $name) = explode(';', $string);
		try {
			$wallet = $this->walletService->getWallet($id, $member);
			if ($wallet->getName() != $name) {
				$wallet->setName($name);
				$wallet = $this->walletDao->update($wallet);
			}
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


	/**
	 * convert csv into Item
	 * @param string $string
	 * @param Member $member
	 * @return Item
	 * @throws FileParseException
	 */
	private function getItem($string, Member $member) {
		if (count(explode(';', $string)) != self::ITEM_FIELDS)
			throw new FileParseException(self::ITEM_FIELDS . ' fields expected, ' . count(explode(';', $string)) . ' given.');
		list($id,
			$name,
			$desc,
			$price,
			$course,
			$date,
			$created,
			$type,
			$active,
			$income,
			$vyber,
			$odepsat,
			$_note,
			$_currency,
			$_wallet
			) = explode(';', $string);
		try {
			if (!trim($id)) throw new NotFoundException();
			$item = $this->itemService->getItem($id);
			self::checkBeforeSettingItem($id, $name, $price, $course, $date, $created, $type, $active, $income, $vyber, $odepsat, $_note, $_currency, $_wallet);
			//needs the item to be updated?
			if ($item->getName() != $name
				|| $item->getDescription() != $desc
				|| $item->getPrice() != $price
				|| $item->getCourse() != $course
				|| $item->getDate()->format('Y-m-d H:i:s') != $date
				|| $item->getType() != $type
				|| $item->isActive() != $active
				|| $item->isIncome() != $income
				|| $item->isVyber() != $vyber
				|| $item->isOdepsat() != $odepsat
				|| (!$item->getNote() && $_note)
				|| ($item->getNote() && $item->getNote()->getId() != $_note)
				|| $item->getCurrency()->getId() != $_currency
				|| $item->getWallet()->getId() != $_wallet
			) {
				$this->setItem($item, $member, $name, $desc, $price, $course, $date, $type, $active, $income, $vyber, $odepsat, $_note, $_currency, $_wallet);
				$item = $this->itemDao->update($item);
			}
		} catch (BadParameterException $e) {
			throw new FileParseException('ItemID not INTEGER or smaller than 1.' . $e->getMessage());
		} catch (FileParseException $e) {
			throw new FileParseException($e->getMessage());
		} catch (NotFoundException $e) {
			if ($name == "")
				throw new FileParseException('Empty name');

			//create new Item
			self::checkBeforeSettingItem($id, $name, $price, $course, $date, $created, $type, $active, $income, $vyber, $odepsat, $_note, $_currency, $_wallet);
			$item = new Item();
			$this->setItem($item, $member, $name, $desc, $price, $course, $date, $type, $active, $income, $vyber, $odepsat, $_note, $_currency, $_wallet);
			$item->setMember($member);

			$res = $this->itemDao->checkExistence($item);
			if (!$res) {
				$item = $this->itemDao->create($item);
			} else {
				//item exists with other ItemID (has same data and FKs) so cannot create new one
			}
		} catch (\Exception $e) {
			throw new FileParseException($e->getMessage());
		}
		return $item;
	}


	/**
	 * @param string $string
	 * @param Wallet $wallet
	 * @return CheckState
	 * @throws FileParseException
	 */
	private function getCheckState($string, Wallet $wallet) {
		if (count(explode(';', $string)) != self::CHECK_STATE_FIELDS)
			throw new FileParseException(self::CHECK_STATE_FIELDS . ' fields expected, ' . count(explode(';', $string)) . ' given.');
		list($id, $walletId, $type, $checked, $value) = explode(';', $string);
		if (!ctype_digit($id)
			|| !ctype_digit($walletId)
			|| !ItemType::isType($type)
			|| (new \DateTime($checked))->format('Y-m-d H:i:s') != $checked
			|| !is_numeric($value)
		) throw new FileParseException('Some field is in bad format.');

		try {
			$checkState = $this->checkStateService->getCheckState($id);
			if ($checkState->getWallet()->getId() != $wallet->getId())
				throw new FileParseException("CheckState's ID refers to other owner");

			$checkState->setType($type)->setChecked(new \DateTime($checked))->setValue($value);
			$this->checkStateDao->update($checkState);
		} catch (\Exception $e) {
			throw new FileParseException($e->getMessage());
		}

		return $checkState;
	}


















	/**
	 * check if all properties are in good form
	 * @param int $id
	 * @param string $name
	 * @param double $price
	 * @param double $course
	 * @param string $date
	 * @param string $created
	 * @param string $type
	 * @param boolean $active
	 * @param boolean $income
	 * @param boolean $vyber
	 * @param boolean $odepsat
	 * @param int $_note
	 * @param int $_currency
	 * @param int $_wallet
	 * @throws FileParseException
	 */
	private static function checkBeforeSettingItem($id, $name, $price, $course, $date, $created, $type, $active, $income, $vyber, $odepsat, $_note, $_currency, $_wallet) {
		if ((trim($id) && !ctype_digit($id))
			|| $name == ""
			|| !is_numeric($price)
			|| !is_numeric($course)
			|| $date != (new \DateTime($date))->format('Y-m-d H:i:s')
			|| ($created != "" && $created != (new \DateTime($created))->format('Y-m-d H:i:s'))
			|| !ItemType::isType($type)
			|| !ctype_digit($active) || ($active != '1' && $active != '0')
			|| !ctype_digit($income) || ($income != '1' && $income != '0')
			|| !ctype_digit($vyber) || ($vyber != '1' && $vyber != '0')
			|| !ctype_digit($odepsat) || ($odepsat != '1' && $odepsat != '0')
			//|| (!ctype_digit($_note) && !$vyber && !$income)
			|| $_currency == ""
			//|| !ctype_digit($_wallet)
		) throw new FileParseException('Some field has bad format');
	}


	/**
	 * @param Item $item
	 * @param Member $member for authentication of ownership of wallet
	 * @param string $name
	 * @param string $desc
	 * @param double $price
	 * @param double $course
	 * @param string $date
	 * @param string $type
	 * @param boolean $active
	 * @param boolean $income
	 * @param boolean $vyber
	 * @param boolean $odepsat
	 * @param int $_note
	 * @param int $_currency
	 * @param int $_wallet
	 * @throws FileParseException
	 */
	private function setItem(Item $item, Member $member, $name, $desc, $price, $course, $date, $type, $active, $income, $vyber, $odepsat, $_note, $_currency, $_wallet) {
		try {
			$note = $_note ? $this->purposeService->getPurpose($_note) : NULL;
			$currency = $this->currencyService->getCurrencyByColumn('code', $_currency);
			$wallet = $this->walletService->getWallet($_wallet, $member);
		} catch (NotFoundException $e) {
			throw new FileParseException("Note, Currency or Wallet with given ID doesn't exist");
		} catch (AuthenticationException $e) {
			throw new FileParseException($e->getMessage());
		}

		$item->setName($name)->setDescription($desc)->setPrice($price)->setCourse($course)
			->setDate(new \DateTime($date))->setType($type)->setActive($active)->setIncome($income)
			->setVyber($vyber)->setOdepsat($odepsat)->setNote($note)->setCurrency($currency)->setWallet($wallet);
	}

}