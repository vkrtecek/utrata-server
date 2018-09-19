<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:46
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Currency;
use App\Model\Service\ICurrencyService;

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

    /** @inheritdoc */
    public function getCurrencies(): array {
		return [ $this->c ];
	}

    /** @inheritdoc */
    public function getCurrency(int $id): Currency {
		return $this->c;
	}

    /** @inheritdoc */
    public function create(array $data): Currency {
		return $this->c;
	}

    /** @inheritdoc */
    public function update(int $id, array $data): Currency {
		return $this->c;
	}

    /** @inheritdoc */
    public function deleteCurrency(int $id) {
		return $id;
	}

    /** @inheritdoc */
    public function getCurrencyByColumn(string $column, string $value): Currency {
		$this->c = new Currency();
		$id = $column != 'languageCode' ? 1 : $column == 'CZK' ? 1 : $column == 'USD' ? 2 : 3;
		$this->c->setId($id);
		$settr = 'set' . $column;
		$this->c->{$settr}($value);
		return $this->c;
	}

    /** @inheritdoc */
    public function format(Currency $currency): array {
		return [];
	}

    /** @inheritdoc */
    public function formatEntities(array $currencies): array {
		return [];
	}
}
