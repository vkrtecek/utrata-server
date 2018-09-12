<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 22. 10. 2017
 * Time: 22:10
 */

namespace App\Model\Dao;


use App\Model\Entity\Currency;
use App\Model\Exception\IntegrityException;

interface ICurrencyDAO
{
    /**
     * @return Currency[]
     */
    public function findAll(): array;

    /**
     * @param $id
     * @return Currency|NULL
     */
    public function findOne(int $id): ?Currency;

    /**
     * @param string $key
     * @param string $val
     * @return Currency|NULL
     */
    public function findOneByColumn(string $key, string $val): ?Currency;

    /**
     * @param Currency $currency
     * @return Currency
     */
    public function create(Currency $currency): Currency;

    /**
     * @param Currency $currency
     * @return Currency
     */
    public function update(Currency $currency): Currency;

    /**
     * @param Currency $currency
     * @throws IntegrityException
     */
    public function delete(Currency $currency);
}
