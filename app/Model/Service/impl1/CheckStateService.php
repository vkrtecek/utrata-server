<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:49
 */

namespace App\Model\Service;


use App\Model\Dao\ICheckStateDAO;
use App\Model\Entity\CheckState;
use App\Model\Entity\Member;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CheckStateService implements ICheckStateService
{
	/** @var ICheckStateDAO */
	protected $checkSateDao;

	/**
	 * CheckStateService constructor.
	 * @param ICheckStateDAO $checkStateDAO
	 */
	public function __construct(ICheckStateDAO  $checkStateDAO) {
		$this->checkSateDao = $checkStateDAO;
	}

	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 * @throws NotFoundException
	 */
	public function getWalletCheckStates(Wallet $wallet) {
		$cs = $this->checkSateDao->findByColumn('WalletID', $wallet->getId());
		if (!$cs || count($cs) == 0)
			throw new NotFoundException('CheckStateService: No check state found.');
		return $cs;
	}

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function getWalletCheckState(Wallet $wallet, $type = ItemType::CARD) {
		$css = $this->getWalletCheckStates($wallet);
		if (count($css) == 0)
			throw new NotFoundException('No CheckState found for wallet (' . $wallet->getId() . ').');
		foreach ($css as $cs)
			if ($cs->getType() == $type) {
				return $cs;
			}
		throw new NotFoundException('No CheckState of such type');
	}

	/**
	 * @param int $id
	 * @return CheckState
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getCheckState($id) {
		if (!ctype_digit($id) || $id < 1)
			throw new BadParameterException('Not INTEGER or smaller that 1');
		$checkState = $this->checkSateDao->findOne($id);
		if (!$checkState)
			throw new NotFoundException('No CheckState found');
		return $checkState;
	}

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 */
	public function createCheckState(Wallet $wallet, $type = ItemType::CARD) {
		$cs = new CheckState();
		$cs->setType($type);
		$cs->setValue(0);
		$cs->setWallet($wallet);
		return $this->checkSateDao->create($cs);
	}
	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @param double $value
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function updateCheckState(Wallet $wallet, $type, $value) {
		$cs = $this->getWalletCheckState($wallet, $type);
		$cs->setValue($value);
		return $this->checkSateDao->update($cs);
	}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteCheckState($id) {
		$this->checkSateDao->delete($id);
		return $id;
	}

	/**
	 * @param CheckState $checkState
	 * @return array
	 */
	public function format(CheckState $checkState) {
		$ret = [];

		$ret['id'] = $checkState->getId();
		$ret['type'] = $checkState->getType();
		$ret['checked'] = $checkState->getChecked()->format('Y-m-d H:i:s');
		$ret['value'] = $checkState->getValue();

		return $ret;
	}

	/**
	 * @param CheckState[] $checkStates
	 * @return array
	 */
	public function formatEntities($checkStates) {}
}