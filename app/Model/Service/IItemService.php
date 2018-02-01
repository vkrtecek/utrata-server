<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 16:09
 */

namespace App\Model\Service;

use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Nette\Application\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface IItemService
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
	 * @param int $limit
	 * @return Item[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWalletItems($walletId, Member $member, $state, $month, $notes, $year, $pattern, $orderBy, $orderHow, $offset);

	/**
	 * @param int $id
	 * @return Item
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getItem($id);

	/**
	 * @param $data
	 * @return Item
	 * @throws BadRequestHttpException
	 */
	public function createItem($data);

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function checkItem($id);

	/**
	 * @param int $walletId
	 * @param Member $member
	 * @param string $month
	 * @param string $notes
	 * @param string $year
	 * @param string $pattern
	 * @param string $orderBy
	 * @param string $orderHow
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkAll($walletId, Member $member, $month, $notes, $year, $pattern, $orderBy, $orderHow);


	/**
	 * @param int $id
	 * @param $data
	 * @return Item
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateItem($id, $data);

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteItem($id);

	/**
	 * @param Item $item
	 * @return array
	 */
	public static function format(Item $item);

	/**
	 * @param Item[] $items
	 * @return array
	 */
	public static function formatEntites($items);
}