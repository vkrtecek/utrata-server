<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 22:32
 */

namespace App\Model\Service;


use App\Model\Dao\ICurrencyDAO;
use App\Model\Entity\Currency;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CurrencyService implements ICurrencyService
{
	/** @var ICurrencyDAO */
	protected $currencyDao;

	/**
	 * CurrencyService constructor.
	 * @param ICurrencyDAO $currencyDAO
	 */
	public function __construct(ICurrencyDAO $currencyDAO) {
		$this->currencyDao = $currencyDAO;
	}

	/**
	 * @return Currency[]
	 * @throws NotFoundException
	 */
	public function getCurrencies() {
		$currencies = $this->currencyDao->findAll();
		if (count($currencies) == 0)
			throw new NotFoundException('No Currency found');
		return $currencies;
	}

	/**
	 * @param int $id
	 * @return Currency
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getCurrency($id) {
		if ((string)((int)$id) != $id || (int)$id < 1)
			throw new BadParameterException('Not integer or smaller than 1');
		$currency = $this->currencyDao->findOne($id);
		if (!$currency)
			throw new NotFoundException('No Currency found');

		return $currency;
	}

	/**
	 * @param string $column column in database
	 * @param mixed $value
	 * @return Currency
	 * @throws NotFoundException
	 */
	public function getCurrencyByColumn($column, $value) {
		$currency = $this->currencyDao->findOneByColumn($column, $value);
		if (!$currency)
			throw new NotFoundException('No Currency found');
		return $currency;
	}

	/**
	 * @param $data
	 * @return Currency
	 * @throws BadRequestHttpException
	 */
	public function createCurrency($data) {}

	/**
	 * @param int $id
	 * @param $data
	 * @return Currency
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateCurrency($id, $data) {}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteCurrency($id) {}

	/**
	 * @param Currency $currency
	 * @return array
	 */
	public function format(Currency $currency) {
		$ret = [];

		$ret['id'] = $currency->getId();
		$ret['code'] = $currency->getCode();
		$ret['value'] = $currency->getValue();
		$ret['name'] = $currency->getName();

		return $ret;

	}

	/**
	 * @param Currency[] $currencies
	 * @return array
	 */
	public function formatEntities($currencies) {
		$ret = [];
		foreach ($currencies as $currency)
			$ret[] = self::format($currency);
		return $ret;
	}
}