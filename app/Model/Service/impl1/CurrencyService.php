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
use App\Model\Exception\NotFoundException;

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

	/** @inheritdoc */
	public function getCurrencies(): array {
		$currencies = $this->currencyDao->findAll();
		if (count($currencies) == 0)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Currency']);
		return $currencies;
	}

    /** @inheritdoc */
    public function getCurrency(int $id): Currency {
		if ($id < 1)
			throw new BadParameterException('Exception.BadParameter.SmallerThan1', 'Identifier smaller than 1');
		$currency = $this->currencyDao->findOne($id);
		if (!$currency)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Currency']);

		return $currency;
	}

    /** @inheritdoc */
    public function getCurrencyByColumn(string $column, string $value): Currency {
		$currency = $this->currencyDao->findOneByColumn($column, $value);
		if (!$currency)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Currency']);
		return $currency;
	}

    /** @inheritdoc */
    public function create(array $data): Currency {}

    /** @inheritdoc */
    public function update(int $id, array $data): Currency {}

    /** @inheritdoc */
    public function deleteCurrency(int $id) {}

    /** @inheritdoc */
    public function format(Currency $currency): array {
		$ret = [];

		$ret['id'] = $currency->getId();
		$ret['code'] = $currency->getCode();
		$ret['value'] = $currency->getValue();
		$ret['name'] = $currency->getName();

		return $ret;

	}

    /** @inheritdoc */
    public function formatEntities(array $currencies): array {
		$ret = [];
		foreach ($currencies as $currency)
			$ret[] = $this->format($currency);
		return $ret;
	}
}
