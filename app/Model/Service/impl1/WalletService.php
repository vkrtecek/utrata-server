<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 15:28
 */

namespace App\Model\Service;


use App\Model\Dao\IWalletDAO;
use App\Model\Entity\Member;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemState;
use App\Model\Enum\ItemType;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use DateTime;

class WalletService implements IWalletService
{
	/** @var IWalletDAO */
	protected $walletDao;

	/** @var IMemberService */
	protected $memberService;

	/**
	 * WalletService constructor.
	 * @param IWalletDAO $walletDao
	 * @param IMemberService $memberService
	 */
	public function __construct(IWalletDAO $walletDao, IMemberService $memberService) {
		$this->walletDao = $walletDao;
		$this->memberService = $memberService;
	}

	/**
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
	public function getWallet($id, Member $member) {
		if ($id == NULL || (string)((int)$id) != $id || (int)$id < 0)
			throw new BadParameterException('WalletService: Not INTEGER or smaller than 1.');
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
	 */
	public function createWallet(Member $member, $name) {
		$wallet = new Wallet();
		$wallet->setMember($member);
		$wallet->setName($name);
		$this->walletDao->create($wallet);
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
		$wallet = $this->walletDao->findOne($id);
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
		$this->walletDao->delete($wallet);
		return $wallet->getId();
	}

	/**
	 * @param Wallet $wallet
	 * @return array
	 */
	public function format(Wallet $wallet) {
		$ret = [];

		$ret['id'] = $wallet->getId();
		$ret['name'] = $wallet->getName();
		$ret['itemsCnt'] = $this->getItemsCount($wallet, ItemState::ALL);
		$ret['activeItemsCnt'] = $this->getItemsCount($wallet, ItemState::UNCHECKED);
		$ret['nonActiveItemsCnt'] = $this->getItemsCount($wallet, ItemState::CHECKED);
		$ret['incomeItemsCnt'] = $this->getItemsCount($wallet, ItemState::INCOMES);
		$ret['cardRest'] = $this->countRest($wallet, ItemType::CARD);
		$ret['cashRest'] = $this->countRest($wallet, ItemType::CASH);
		$ret['monthExpense'] = $this->countMonthExpense($wallet);
		$ret['empty'] = count($wallet->getItems()) == 0;

		return $ret;
	}

	/**
	 * @param Wallet[] $wallets
	 * @return array
	 */
	public function formatEntities($wallets) {
		if (!$wallets)
			return NULL;
		$ret = [];
		foreach ($wallets as $wallet)
			$ret[] = self::format($wallet);
		return $ret;
	}






	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return double
	 */
	private function countRest(Wallet $wallet, $type = ItemType::CARD) {
		$minus = $plus = 0;
		foreach ($wallet->getItems() as $item) {
			if ($item->getType() == $type) {
				$amount = ($item->getPrice() * $item->getCourse());
				if ($item->isIncome())
					$plus += $amount;
				else
					$minus += $amount;
			}
		}
		return $plus - $minus;
	}

	/**
	 * @param Wallet $wallet
	 * @return double
	 */
	private function countMonthExpense(Wallet $wallet) {
		$expense = 0;
		foreach ($wallet->getItems() as $item) {
			if ($item->getDate()->format('Y-m') == (new DateTime())->format('Y-m')) {
				if ($item->isIncome())
					$expense += ($item->getPrice() * $item->getCourse());
				else
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
		$items = $wallet->getItems();
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
					if ($item->isIncome() && !$item->isVyber())
						$cnt++;
				}
				break;
		}
		return $cnt;
	}
}