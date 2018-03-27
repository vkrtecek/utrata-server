<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 3. 2018
 * Time: 0:00
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\ICheckStateDAO;
use App\Model\Entity\CheckState;

class FakeCheckStateDAO implements ICheckStateDAO
{
	/**
	 * @return CheckState[]|NULL
	 */
	public function findAll() {}

	/**
	 * @param int $id
	 * @return CheckState|NULL
	 */
	public function findOne($id) {}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return CheckState|NULL
	 */
	public function findByColumn($key, $val) {}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return CheckState|NULL
	 */
	public function findLastByColumn($key, $val) {}

	/**
	 * @param CheckState $checkState
	 * @return CheckState
	 */
	public function create(CheckState $checkState) {}

	/**
	 * @param CheckState $checkState
	 * @return CheckState
	 */
	public function update(CheckState $checkState) {}

	/**
	 * @param int $id
	 * @return void
	 */
	public function delete($id) {}
}