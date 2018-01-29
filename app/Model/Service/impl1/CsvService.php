<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:53
 */

namespace App\Model\Service;


use App\Model\Entity\CheckState;
use App\Model\Entity\File;
use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Entity\Wallet;

class CsvService implements IFileService
{
	/** @var IWalletService */
	protected $walletService;

	/** @var ICheckStateService */
	protected $checkStateService;

	/** @var IPurposeService */
	protected $purposeService;

	/**
	 * CsvService constructor.
	 * @param IWalletService $walletService
	 * @param ICheckStateService $checkStateService
	 * @param IPurposeService $purposeService
	 */
	public function __construct(IWalletService $walletService, ICheckStateService $checkStateService, IPurposeService $purposeService) {
		$this->walletService = $walletService;
		$this->checkStateService = $checkStateService;
		$this->purposeService = $purposeService;
	}

	/**
	 * @param Member $member
	 * @return string
	 */
	public function getBackup(Member $member) {
		$content = new File();
		$content->append(self::formatMember($member));

		//purposes
		$memberPurposes = $member->getMemberPurposes();
		$content->append(count($memberPurposes));
		foreach ($memberPurposes as $memberPurpose) {
			$purpose = $memberPurpose->getPurpose();
			$content->append(self::formatPurpose($purpose));
		}

		//wallets
		$wallets = $member->getWallets();
		$content->append(count($wallets));
		foreach ($wallets as $wallet)
			$content->append(self::formatWallet($wallet));

		//items
		$items = $member->getItems();
		$content->append(count($items));
		foreach ($items as $item)
			$content->append(self::formatItem($item));


		//checksates
		$checkStates = $member->getCheckStates();
		$content->append(count($checkStates));
		foreach ($checkStates as $checkState)
			$content->append(self::formatCheckState($checkState));


		return $content->getContent();
	}

	/**
	 * @param Member $member
	 * @param string $file
	 * @return boolean
	 */
	public function storeBackup(Member $member, $file) {
		// TODO: Implement storeBackup() method.
	}












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

	private static function formatWallet(Wallet $wallet) {
		return $wallet->getId() . ';' .
			$wallet->getName() . ';' .
			$wallet->getCreated()->format('Y-m-d H:i:s');
	}

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

	private static function formatCheckState(CheckState $checkState) {
		return $checkState->getType() . ';' .
			$checkState->getChecked()->format('Y-m-d H:i:s') . ';' .
			$checkState->getValue();
	}

	private static function formatPurpose(Purpose $purpose) {
		return $purpose->getId();
	}

}