<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 22. 10. 2017
 * Time: 22:11
 */

namespace App\Model\Dao;


use App\Model\Entity\Currency;

class CurrencyDAO extends AbstractDAO implements ICurrencyDAO
{
    /** @inheritdoc */
    public function findAll(): array {
        return $this->convertToArray(Currency::all());
    }

    /** @inheritdoc */
    public function findOne(int $id): ?Currency {
        return Currency::find($id);
    }

    /** @inheritdoc */
    public function findOneByColumn(string $key, string $val): ?Currency {
        return Currency::where($key, $val)->first();
    }

    /** @inheritdoc */
    public function create(Currency $currency): Currency {
    	$currency->save();
        return $currency;
    }

    /** @inheritdoc */
    public function update(Currency $currency): Currency {
        $currency->save();
        return $currency;
    }

    /** @inheritdoc */
    public function delete(Currency $currency) {
        $currency->delete();
    }
}
