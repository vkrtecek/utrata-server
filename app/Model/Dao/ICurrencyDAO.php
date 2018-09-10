<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 22. 10. 2017
 * Time: 22:10
 */

namespace App\Model\Dao;


use App\Model\Entity\Currency;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;

interface ICurrencyDAO
{
    /**
     * @return Currency[]|NULL
     */
    public function findAll();

    /**
     * @param $id
     * @return Currency|NULL
     */
    public function findOne($id);

    /**
     * @param Currency $currency
     * @return Currency
     */
    public function create(Currency $currency);

    /**
     * @param Currency $currency
     * @return Currency
     */
    public function update(Currency $currency);

    /**
     * @param Currency $currency
     * @throws IntegrityException
     */
    public function delete(Currency $currency);

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Currency
	 */
	public function findOneByColumn($key, $val);
}
