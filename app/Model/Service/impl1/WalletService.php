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
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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

	/**
	 * get all user's wallets
	 * @param string $login
	 * @return Wallet[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getWallets($login) {
		$member = $this->memberService->getMember($login);
		return $this->walletDao->findByColumn('MemberID', $member->getId());
	}

	/**
	 * @param int $id
	 * @param Member $member
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWallet(int $id, Member $member) {
		if (!preg_match('/^[1-9][0-9]*[ ]*$/', $id))
			throw new BadParameterException('WalletService: Not INTEGER or smaller than 1. -> ' . $id);
		$wallet = $this->walletDao->findOne($id);
		if ($wallet == NULL)
			throw new NotFoundException('WalletService: No result found.');
		if ($wallet->getMember()->getId() != $member->getId())
			throw new AuthenticationException('WalletService: Member is not owner of this wallet.');
		return $wallet;
	}

	/**
	 * @param Member $member
	 * @param string $name
	 * @return Wallet
	 * @throws BadParameterException
	 */
	public function createWallet(Member $member, $name) {
		if (!$name)
			throw new BadParameterException($this->translationsService->getTranslation('Wallet.Create.Error.Empty.Name', $member->getLanguage()->getCode(), 'Empty name')->getValue());
		$wallet = new Wallet();
		$wallet->setMember($member);
		$wallet->setName($name);
		$wallet = $this->walletDao->create($wallet);
		$this->createStartingCheckstates($wallet);
		return $wallet;
	}

	/**
	 * @param Member $member
	 * @param int $id
	 * @param string $name
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 * @throws AuthenticationException
	 */
	public function updateWallet(Member $member, $id, $name) {
		if (!$name)
			throw new BadParameterException($this->translationsService->getTranslation('Wallet.Update.Error.Empty.Name', $member->getLanguage()->getCode(), 'Empty name')->getValue());
		$wallet = $this->getWallet($id, $member);
		if ($wallet->getMember()->getId() !== $member->getId())
			throw new AuthenticationException('WalletService: Member is not owner of this wallet.');
		$wallet->setName($name);
		$this->walletDao->update($wallet);
		return $wallet;
	}

	/**
	 * @param int $id
	 * @param Member $member
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 * @throws IntegrityException
	 */
	public function deleteWallet($id, Member $member) {
		$wallet = $this->getWallet($id, $member);
		$this->deleteCheckstates($wallet);
		$this->walletDao->delete($wallet);
		return $wallet->getId();
	}

	/**
	 * @param Wallet $wallet
	 * @return array
	 * @throws UnderEntityNotFoundException
	 */
	public function format(Wallet $wallet) {
		$ret = [];

		$ret['id'] = $wallet->getId();
		$ret['name'] = $wallet->getName();
		$ret['itemsCnt'] = $this->getItemsCount($wallet, ItemState::ALL);
		$ret['activeItemsCnt'] = $this->getItemsCount($wallet, ItemState::UNCHECKED);
		$ret['nonActiveItemsCnt'] = $this->getItemsCount($wallet, ItemState::CHECKED);
		$ret['incomeItemsCnt'] = $this->getItemsCount($wallet, ItemState::INCOMES);
		$ret['cardRest'] = number_format($this->countRest($wallet, ItemType::CARD), 2, ',', ' ');
		$ret['cashRest'] = number_format($this->countRest($wallet, ItemType::CASH), 2, ',', ' ');
		$ret['checkState'] = [
			"card" => $this->checkStateService->format($this->getCheckState($wallet, ItemType::CARD)),
			"cash" => $this->checkStateService->format($this->getCheckState($wallet, ItemType::CASH))
		];
		$ret['monthExpense'] = $this->countMonthExpense($wallet);
		$ret['empty'] = count($this->walletDao->getItems($wallet)) == 0;
		return $ret;
	}

	/**
	 * @param Wallet[] $wallets
	 * @return array
	 * @throws UnderEntityNotFoundException
	 */
	public function formatEntities($wallets) {
		if (!$wallets)
			return NULL;
		$ret = [];
		foreach ($wallets as $wallet) {
			$ret[] = $this->format($wallet);
		}
		return $ret;
	}



	/**
	 * @param Member $member
	 * @param int $walletId
	 * @param string $type
	 * @param double $value
	 * @return array
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function updateCheckState(Member $member, $walletId, $type, $value) {
		$wallet = $this->getWallet($walletId, $member);
		$cs = $this->checkStateService->updateCheckState($wallet, $type, $value);
		return $this->checkStateService->format($cs);
	}









	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return double
	 */
	private function countRest(Wallet $wallet, $type = ItemType::CARD) {
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
	private function countMonthExpense(Wallet $wallet) {
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
	private function getItemsCount($wallet, $state = ItemState::ALL) {
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
	 */
	private function createStartingCheckstates(Wallet $wallet) {
		$this->checkStateService->createCheckState($wallet, ItemType::CARD);
		$this->checkStateService->createCheckState($wallet, ItemType::CASH);
	}

	/**
	 * @param Wallet $wallet
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
			throw new UnderEntityNotFoundException($e->getMessage());
		}
	}
}
