<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 22. 10. 2017
 * Time: 22:11
 */

namespace App\Model\Dao;


use App\Model\Entity\Currency;
use App\Model\Exception\IntegrityException;

class CurrencyDAO implements ICurrencyDAO
{
    /**
     * @return Currency[]
     */
    public function findAll() {
        return Currency::all();
    }

    /**
     * @param int $id
     * @return Currency
     */
    public function findOne($id) {
        return Currency::find($id);
    }

    /**
     * @param Currency $currency
     * @return Currency
     */
    public function create(Currency $currency) {
    	$currency->save();
        return $currency;
    }

    /**
     * @param Currency $currency
     * @return Currency
     */
    public function update(Currency $currency) {
        $currency->save();
        return $currency;
    }

    /**
     * @param Currency $currency
     * @throws IntegrityException
     */
    public function delete(Currency $currency) {
        try {
        	$currency->delete();
        } catch (\Exception $ex) {
            //FK key violation
            throw new IntegrityException($ex->getMessage(), 0, $ex);
        }
    }

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Currency
	 */
    public function findOneByColumn($key, $val) {
    	return Currency::where($key, $val)->first();
	}
}