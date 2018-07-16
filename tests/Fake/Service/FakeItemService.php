<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:37
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Enum\ItemState;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IItemService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tests\Fake\Dao\FakeItemDAO;

class FakeItemService implements IItemService
{
	/**
	 * @param int $walletId
	 * @param Member $member
	 * @param int $state
	 * @param string $month
	 * @param string $notes
	 * @param string $year
	 * @param string $pattern
	 * @param string $orderBy
	 * @param string $orderHow
	 * @param int $offset
	 * @return Item[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWalletItems($walletId, Member $member, $state = ItemState::UNCHECKED, $month = '', $notes = '', $year = '', $pattern = '', $orderBy = '', $orderHow = '', $offset = 30) {
		return (new FakeItemDAO())->findAll();
	}


	/**
	 * @param Member $member
	 * @param int $walletId
	 * @param string $purposes expected in form like "1,3,5,7"
	 * @return array
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getMonthStatistics(Member $member, $walletId, $purposes = NULL) {}

	/**
	 * @param int $id
	 * @return Item
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getItem($id) {
		return (new FakeItemDAO())->findOne($id);
	}

	/**
	 * @param Member $member
	 * @param $data
	 * @return Item
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 * @throws NotFoundException
	 */
	public function createItem(Member $member, $data) {}

	/**
	 * @param Member $member
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkItem(Member $member, $id) {}

	/**
	 * @param int $walletId
	 * @param Member $member
	 * @param string $month
	 * @param string $notes
	 * @param string $year
	 * @param string $pattern
	 * @param string $orderBy
	 * @param string $orderHow
	 * @param int $limit
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkAll($walletId, Member $member, $month, $notes, $year, $pattern, $orderBy, $orderHow, $limit) {}


	/**
	 * @param Member $member
	 * @param int $id
	 * @param $data
	 * @return Item
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateItem(Member $member, $id, $data) {}

	/**
	 * @param Member $member
	 * @param int $id id of item
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteItem(Member $member, $id) {}

	/**
	 * @param Item $item
	 * @param Member $member
	 * @return array
	 */
	public function format(Item $item, Member $member) {}

	/**
	 * @param Item[] $items
	 * @param Member $member
	 * @return array
	 */
	public function formatEntities($items, Member $member) {}
}