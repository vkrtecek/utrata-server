<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:46
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Currency;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ICurrencyService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FakeCurrencyService implements ICurrencyService
{
	/** @var Currency */
	private $c;

	public function __construct() {
		$this->c = new Currency();
		$this->c->setId(1);
		$this->c->setCode('CZK');
		$this->c->setValue('Kč');
		$this->c->setName('Česká koruna');
	}

	/**
	 * @return Currency[]
	 * @throws NotFoundException
	 */
	public function getCurrencies() {
		return [ $this->c ];
	}

	/**
	 * @param int $id
	 * @return Currency
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getCurrency($id) {
		return $this->c;
	}

	/**
	 * @param $data
	 * @return Currency
	 * @throws BadRequestHttpException
	 */
	public function createCurrency($data) {
		return $this->c;
	}

	/**
	 * @param int $id
	 * @param $data
	 * @return Currency
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateCurrency($id, $data) {
		return $this->c;
	}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteCurrency($id) {
		return $id;
	}

	/**
	 * @param string $column column in database
	 * @param mixed $value
	 * @return Currency
	 */
	public function getCurrencyByColumn($column, $value) {
		$this->c = new Currency();
		$id = $column != 'languageCode' ? 1 : $column == 'CZK' ? 1 : $column == 'USD' ? 2 : 3;
		$this->c->setId($id);
		$settr = 'set' . $column;
		$this->c->{$settr}($value);
		return $this->c;
	}

	/**
	 * @param Currency $currency
	 * @return array
	 */
	public function format(Currency $currency) {
		return [];
	}

	/**
	 * @param Currency[] $currencies
	 * @return array
	 */
	public function formatEntities($currencies) {
		return [];
	}
}