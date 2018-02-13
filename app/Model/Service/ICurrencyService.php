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
    public function getCurrencies();

    /**
     * @param int $id
     * @return Currency
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function getCurrency($id);

    /**
     * @param $data
     * @return Currency
     * @throws BadRequestHttpException
     */
    public function createCurrency($data);

    /**
     * @param int $id
     * @param $data
     * @return Currency
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws BadRequestHttpException
     */
    public function updateCurrency($id, $data);

    /**
     * @param int $id
     * @return int
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws IntegrityException
     */
    public function deleteCurrency($id);

	/**
	 * @param string $column column in database
	 * @param mixed $value
	 * @return Currency
	 */
	public function getCurrencyByColumn($column, $value);

	/**
	 * @param Currency $currency
	 * @return array
	 */
	public function format(Currency $currency);

	/**
	 * @param Currency[] $currencies
	 * @return array
	 */
	public function formatEntities($currencies);
}