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
     * @return CheckState[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return CheckState|NULL
     */
    public function findOne(int $id): ?CheckState;

	/**
	 * @param string $key
	 * @param string $val
	 * @return CheckState[]
	 */
	public function findByColumn(string $key, string $val): array;

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return CheckState|NULL
	 */
	public function findLastByColumn(string $key, string $val): ?CheckState;

	/**
	 * @param CheckState $checkState
	 * @return CheckState
	 */
	public function create(CheckState $checkState): CheckState;

	/**
	 * @param CheckState $checkState
	 * @return CheckState
	 */
	public function update(CheckState $checkState): CheckState;

	/**
	 * @param CheckState $cs
	 * @throws IntegrityException
	 */
	public function delete(CheckState $cs);

}
