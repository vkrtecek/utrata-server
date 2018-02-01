<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 15. 11. 2017
 * Time: 22:00
 */

namespace App\Model\Dao;


use App\Model\Entity\CheckState;
use App\Model\Exception\IntegrityException;

interface ICheckStateDAO
{
    /**
     * @return CheckState[]|NULL
     */
    public function findAll();

    /**
     * @param int $id
     * @return CheckState|NULL
     */
    public function findOne($id);

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return CheckState|NULL
	 */
	public function findLastByColumn($key, $val);

	/**
	 * @param CheckState $checkState
	 * @return CheckState
	 */
	public function create(CheckState $checkState);

	/**
	 * @param CheckState $checkState
	 * @return CheckState
	 */
	public function update(CheckState $checkState);

}