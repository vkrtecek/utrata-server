<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 16. 11. 2017
 * Time: 1:54
 */

namespace App\Model\Dao;


use App\Model\Entity\Item;
use App\Model\Entity\Purpose;
use App\Model\Exception\IntegrityException;

interface IPurposeDAO
{
    /**
     * @return Purpose[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Purpose|NULL
     */
    public function findOne(int $id): ?Purpose;

	/**
	 * @param string $key
	 * @param string $val
	 * @return Purpose[]
	 */
	public function findByColumn(string $key, string $val): array;

	/**
	 * @param Purpose $purpose
	 * @return Item[]
	 */
	public function findItems(Purpose $purpose): array;

    /**
     * @param Purpose $purpose
     * @return Purpose
     */
    public function create(Purpose $purpose): Purpose;

    /**
     * @param Purpose $purpose
     * @return Purpose
     */
    public function update(Purpose $purpose): Purpose;

    /**
     * @param Purpose $purpose
     * @throws IntegrityException
     */
    public function delete(Purpose $purpose);

}
