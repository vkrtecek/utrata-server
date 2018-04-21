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
     * @return Purpose[]|NULL
     */
    public function findAll();

    /**
     * @param int $id
     * @return Purpose|NULL
     */
    public function findOne($id);

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Purpose[]|NULL
	 */
	public function findByColumn($key, $val);

	/**
	 * @param Purpose $purpose
	 * @return Item[]|NULL
	 */
	public function findItems(Purpose $purpose);

    /**
     * @param Purpose $purpose
     * @return Purpose
     */
    public function create(Purpose $purpose);

    /**
     * @param Purpose $purpose
     * @return Purpose
     */
    public function update(Purpose $purpose);

    /**
     * @param Purpose $purpose
     * @throws IntegrityException
     */
    public function delete(Purpose $purpose);

}