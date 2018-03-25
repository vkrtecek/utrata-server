<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 0:00
 */

namespace Tests\Fake\Service;


use App\Model\Entity\CheckState;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ICheckStateService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FakeCheckStateService implements ICheckStateService
{
	/** @var CheckState */
	protected $cs1;
	/** @var CheckState */
	protected $cs2;

	public function __construct() {
		$this->cs1 = new CheckState();
		$this->cs1->setType(ItemType::CARD);
		$this->cs1->setChecked(new \DateTime());
		$this->cs1->setValue(100);
		$this->cs2 = new CheckState();
		$this->cs2->setType(ItemType::CASH);
		$this->cs2->setChecked(new \DateTime());
		$this->cs2->setValue(30);
	}

	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 * @throws NotFoundException
	 */
	public function getWalletCheckStates(Wallet $wallet) {}

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function getWalletCheckState(Wallet $wallet, $type = ItemType::CARD) {
		if ($type == ItemType::CARD)
			return $this->cs1;
		else
			return $this->cs2;
	}

	/**
	 * @param int $id
	 * @return CheckState
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getCheckState($id) {}

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws BadRequestHttpException
	 */
	public function createCheckState(Wallet $wallet, $type = ItemType::CARD) {}

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @param double $value
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function updateCheckState(Wallet $wallet, $type, $value) {}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteCheckState($id) {}

	/**
	 * @param CheckState $checkState
	 * @return array
	 */
	public function format(CheckState $checkState) {
		return [];
	}

	/**
	 * @param CheckState[] $checkStates
	 * @return array
	 */
	public function formatEntities($checkStates) {
		return [];
	}
}