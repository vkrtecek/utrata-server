<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 19. 10. 2017
 * Time: 19:21
 */

namespace App\Model\Service;


use App\Model\Entity\Language;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;

interface ILanguageService
{
    /**
     * @return Language[]
     * @throws NotFoundException
     */
    public function getLanguages(): array;

    /**
     * @param string $code
     * @return Language
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function getLanguage(string $code): Language;

    /**
     * @param array $data
     * @return Language
     * @throws AlreadyExistException
     * @throws BadParameterException
     * @throws BadRequestException
     */
    public function createLanguage(array $data): Language;

    /**
     * @param string $code
     * @param array $data
     * @return Language
     * @throws BadParameterException
     * @throws NotFoundException
     * @throws BadRequestException
     */
    public function updateLanguage(string $code, array $data): Language;

    /**
     * @param string $code
     * @throws BadParameterException
     * @throws NotFoundException
     * @throws IntegrityException
     */
    public function deleteLanguage(string $code);

	/**
	 * @param Language $language
	 * @return array
	 */
	public function format(Language $language): array;

	/**
	 * @param Language[] $languages
	 * @return array
	 */
	public function formatEntites(array $languages): array;
}
