<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 4:53
 */

namespace App\Model\Service;


use App\Model\Entity\CheckState;
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
		$content = '';
		$content .= self::formatMember($member);

		return $content;
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

	}

	private static function formatWallet(Wallet $wallet) {

	}

	private static function formatItem(Item $item) {

	}

	private static function formatCheckState(CheckState $checkState) {

	}

	private static function formatPurpose(Purpose $purpose) {
		
	}

}