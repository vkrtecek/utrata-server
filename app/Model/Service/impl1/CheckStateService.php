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

	/** @inheritdoc */
	public function getWalletCheckStates(Wallet $wallet): array {
		$cs = $this->checkSateDao->findByColumn('WalletID', $wallet->getId());
		if (count($cs) == 0)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'CheckState']);
		return $cs;
	}

    /** @inheritdoc */
    public function getWalletCheckState(Wallet $wallet, string $type = ItemType::CARD): CheckState {
		$css = $this->getWalletCheckStates($wallet);
		if (count($css) == 0)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'CheckState']);
		foreach ($css as $cs)
			if ($cs->getType() == $type) {
				return $cs;
			}
        throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'CheckState']);
	}

    /** @inheritdoc */
    public function getCheckState(int $id): CheckState {
		if ($id < 1)
			throw new BadParameterException('Exception.BadParameter.SmallerThan1', 'Identifier smaller than 1');
		$checkState = $this->checkSateDao->findOne($id);
		if (!$checkState)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'CheckState']);
		return $checkState;
	}

    /** @inheritdoc */
    public function createCheckState(Wallet $wallet, string $type = ItemType::CARD): CheckState {
		$cs = new CheckState();
		$cs->setType($type);
		$cs->setValue(0);
		$cs->setWallet($wallet);
		return $this->checkSateDao->create($cs);
	}

	/** @inheritdoc */
    public function updateCheckState(Wallet $wallet, string $type, float $value): CheckState {
		$cs = $this->getWalletCheckState($wallet, $type);
		$cs->setValue($value);
		return $this->checkSateDao->update($cs);
	}

    /** @inheritdoc */
    public function deleteCheckState(int $id) {
	    $cs = $this->getCheckState($id);
		$this->checkSateDao->delete($cs);
		return $id;
	}

    /** @inheritdoc */
    public function format(CheckState $checkState): array {
		$ret = [];

		$ret['id'] = $checkState->getId();
		$ret['type'] = $checkState->getType();
		$ret['checked'] = $checkState->getChecked()->format('Y-m-d H:i:s');
		$ret['value'] = number_format($checkState->getValue(), 2, ',', ' ');

		return $ret;
	}

    /** @inheritdoc */
    public function formatEntities(array $checkStates): array {
        $ret = [];
        foreach ($checkStates as $checkState)
            $ret[] = $checkState;
        return $ret;
    }
}
