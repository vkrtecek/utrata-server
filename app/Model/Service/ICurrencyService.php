<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 22. 10. 2017
 * Time: 22:17
 */

namespace App\Model\Service;


use App\Model\Entity\Currency;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface ICurrencyService
{
    /**
     * @return Currency[]
     * @throws NotFoundException
     */
    public function getCurrencies(): array;

    /**
     * @param int $id
     * @return Currency
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function getCurrency(int $id): Currency;

    /**
     * @param string $column column in database
     * @param mixed $value
     * @return Currency
     * @throws NotFoundException
     */
    public function getCurrencyByColumn(string $column, string $value): Currency;

    /**
     * @param $data
     * @return Currency
     * @throws BadRequestHttpException
     */
    public function create(array $data): Currency;

    /**
     * @param int $id
     * @param $data
     * @return Currency
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws BadRequestHttpException
     */
    public function update(int $id, array $data): Currency;

    /**
     * @param int $id
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws IntegrityException
     */
    public function deleteCurrency(int $id);

	/**
	 * @param Currency $currency
	 * @return array
	 */
	public function format(Currency $currency): array;

	/**
	 * @param Currency[] $currencies
	 * @return array
	 */
	public function formatEntities(array $currencies): array;
}
