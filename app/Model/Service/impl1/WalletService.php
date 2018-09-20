<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 15:28
 */

namespace App\Model\Service;


use App\Model\Dao\IWalletDAO;
use App\Model\Entity\CheckState;
use App\Model\Entity\Member;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemState;
use App\Model\Enum\ItemType;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\UnderEntityNotFoundException;
use DateTime;

class WalletService implements IWalletService
{
	/** @var IWalletDAO */
	protected $walletDao;

	/** @var IMemberService */
	protected $memberService;

	/** @var ICheckStateService */
	protected $checkStateService;

	/** @var ITranslationService */
	protected $translationsService;

	/**
	 * WalletService constructor.
	 * @param IWalletDAO $walletDao
	 * @param IMemberService $memberService
	 * @param ICheckStateService $checkStateService
	 * @param ITranslationService $translationService
	 */
	public function __construct(IWalletDAO $walletDao, IMemberService $memberService, ICheckStateService $checkStateService, ITranslationService $translationService) {
		$this->walletDao = $walletDao;
		$this->memberService = $memberService;
		$this->checkStateService = $checkStateService;
		$this->translationsService = $translationService;
	}

	/** @inheritdoc */
	public function getWallets(string $login): array {
		$member = $this->memberService->getMember($login);
		return $this->walletDao->findByColumn('MemberID', $member->getId());
	}

    /** @inheritdoc */
    public function getWallet(int $id, Member $member): Wallet {
		if ($id < 1)
			throw new BadParameterException('Exception.BadParameter.SmallerThan1', 'Identifier smaller than 1');
		$wallet = $this->walletDao->findOne($id);
		if ($wallet == NULL)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Wallet']);
		if ($wallet->getMember()->getId() != $member->getId())
            throw (new AuthenticationException('Exception.UserNotOwner', 'User is not owner of this :entity'))->setBind(['entity' => 'Wallet']);
		return $wallet;
	}

	/** @inheritdoc */
    public function getByMember(Member $member): array {
        return $this->walletDao->findByColumn('MemberID', $member->getId());
    }

    /** @inheritdoc */
    public function createWallet(Member $member, string $name): Wallet {
		if (!$name)
			throw (new BadParameterException('Exception.Parameter.Empty', 'Empty :parameter'))->setBind(['parameter' => 'name']);
		$wallet = new Wallet();
		$wallet->setMember($member);
		$wallet->setName($name);
		$wallet = $this->walletDao->create($wallet);
		$this->createStartingCheckstates($wallet);
		return $wallet;
	}

    /** @inheritdoc */
    public function updateWallet(Member $member, int $id, string $name): Wallet {
		if (!$name)
			throw (new BadParameterException('Exception.Parameter.Empty', 'Empty :parameter'))->setBind(['parameter' => 'name']);
		$wallet = $this->getWallet($id, $member);
		if ($wallet->getMember()->getId() !== $member->getId())
			throw (new AuthenticationException('Exception.UserNotOwner', 'User is not owner of this :entity'))->setBind(['entity' => 'Wallet']);
		$wallet->setName($name);
		$this->walletDao->update($wallet);
		return $wallet;
	}

    /** @inheritdoc */
    public function deleteWallet(int $id, Member $member) {
		$wallet = $this->getWallet($id, $member);
		$this->deleteCheckstates($wallet);
		$this->walletDao->delete($wallet);
		return $wallet->getId();
	}

    /** @inheritdoc */
    public function format(Wallet $wallet): array {
		$ret = [];

		$ret['id'] = $wallet->getId();
		$ret['name'] = $wallet->getName();
		$ret['itemsCnt'] = $this->getItemsCount($wallet, ItemState::ALL);
		$ret['activeItemsCnt'] = $this->getItemsCount($wallet, ItemState::UNCHECKED);
		$ret['nonActiveItemsCnt'] = $this->getItemsCount($wallet, ItemState::CHECKED);
		$ret['incomeItemsCnt'] = $this->getItemsCount($wallet, ItemState::INCOMES);
		$ret['cardRest'] = $this->countRest($wallet, ItemType::CARD);
		$ret['cashRest'] = $this->countRest($wallet, ItemType::CASH);
		$ret['checkState'] = [
			"card" => $this->checkStateService->format($this->getCheckState($wallet, ItemType::CARD)),
			"cash" => $this->checkStateService->format($this->getCheckState($wallet, ItemType::CASH))
		];
		$ret['monthExpense'] = $this->countMonthExpense($wallet);
		$ret['empty'] = count($this->walletDao->getItems($wallet)) == 0;
		return $ret;
	}

    /** @inheritdoc */
    public function formatEntities(array $wallets): array {
		if (!$wallets)
			return NULL;
		$ret = [];
		foreach ($wallets as $wallet) {
			$ret[] = $this->format($wallet);
		}
		return $ret;
	}



    /** @inheritdoc */
    public function updateCheckState(Member $member, int $walletId, string $type, float $value): array {
		$wallet = $this->getWallet($walletId, $member);
		$cs = $this->checkStateService->updateCheckState($wallet, $type, $value);
		return $this->checkStateService->format($cs);
	}









	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return double
	 */
	private function countRest(Wallet $wallet, string $type = ItemType::CARD): float {
		$minus = $plus = 0;
		foreach ($this->walletDao->getItems($wallet) as $item) {
			$amount = ($item->getPrice() * $item->getCourse());

			if ($item->getType() == $type && $item->isIncome() && !$item->isVyber())
				$plus += $amount;
			elseif ($item->getType() == $type && !$item->isIncome() && !$item->isVyber())
				$minus += $amount;
			elseif ($type == ItemType::CASH && $item->isVyber())
				$plus += $amount;
			elseif ($type == ItemType::CARD && $item->isVyber())
				$minus += $amount;
		}
		return $plus - $minus;
	}

	/**
	 * @param Wallet $wallet
	 * @return double
	 */
	private function countMonthExpense(Wallet $wallet): float {
		$expense = 0;
		foreach ($this->walletDao->getItems($wallet) as $item) {
			if ($item->getDate()->format('Y-m') == (new DateTime())->format('Y-m')) {
				if ($item->isIncome() && !$item->isVyber())
					$expense += ($item->getPrice() * $item->getCourse());
				else if (!$item->isIncome())
					$expense -= ($item->getPrice() * $item->getCourse());
			}
		}
		return $expense;
	}

	/**
	 * @param Wallet $wallet
	 * @param int $state
	 * @return int
	 */
	private function getItemsCount(Wallet $wallet, int $state = ItemState::ALL): int {
		$items = $this->walletDao->getItems($wallet);
		$cnt = 0;
		switch ($state) {
			case ItemState::UNCHECKED:
				foreach ($items as $item) {
					if (!$item->isIncome() && !$item->isVyber() && $item->isActive())
						$cnt++;
				}
				break;
			case ItemState::CHECKED:
				foreach ($items as $item) {
					if (!$item->isIncome() && !$item->isVyber() && !$item->isActive())
						$cnt++;
				}
				break;
			case ItemState::ALL:
				foreach ($items as $item) {
					if (!$item->isIncome() && !$item->isVyber())
						$cnt++;
				}
				break;
			case ItemState::INCOMES:
				foreach ($items as $item) {
					if ($item->isIncome() && !$item->isVyber()) //ATM pick is not an income
						$cnt++;
				}
				break;
		}
		return $cnt;
	}


	/**
	 * creates 2 beggining CheckStates. For card and cash with value of 0
	 * @param Wallet $wallet
     * @throws BadParameterException
	 */
	private function createStartingCheckstates(Wallet $wallet) {
		$this->checkStateService->createCheckState($wallet, ItemType::CARD);
		$this->checkStateService->createCheckState($wallet, ItemType::CASH);
	}

	/**
	 * @param Wallet $wallet
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws IntegrityException
	 */
	private function deleteCheckstates(Wallet $wallet) {
		foreach ($this->checkStateService->getWalletCheckStates($wallet) as $cs)
			$this->checkStateService->deleteCheckState($cs->getId());
	}

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws UnderEntityNotFoundException
	 */
	protected function getCheckState(Wallet $wallet, $type = ItemType::CARD) {
		try {
			return $this->checkStateService->getWalletCheckState($wallet, $type);
		} catch (NotFoundException $e) {
			throw (new UnderEntityNotFoundException($e->getMessage(), $e->getDefault()))->setBind($e->getBinds());
		}
	}
}
