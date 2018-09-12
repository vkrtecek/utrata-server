<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 16. 11. 2017
 * Time: 19:10
 */

namespace App\Model\Service;


use App\Model\Entity\Language;
use App\Model\Entity\Translation;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;

interface ITranslationService
{
	/**
	 * @return Translation[]
	 * @throws NotFoundException
	 */
	public function getTranslations(): array;

	/**
	 * @param string $languageCode
	 * @return Translation[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getTranslationsByLanguage(string $languageCode): array;

    /**
     * @param string $code
     * @param string $language
	 * @param string $default
     * @return Translation
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function getTranslation(string $code, string $language, string $default = ''): Translation;

	/**
	 * @param string $code
	 * @param Language $language
	 * @param string $default
	 * @return string
	 * @throws BadParameterException
     * @throws NotFoundException
	 */
	public function getTranslationDefault(string $code, Language $language, string $default = ''): string;

	/**
	 * @param string $code
	 * @param string $default
	 * @return string
     * @throws BadParameterException
     * @throws NotFoundException
	 */
	public function get(string $code, string $default = ''): string;

    /**
     * @param array $data
     * @return Translation
     * @throws AlreadyExistException
     * @throws BadParameterException
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function createTranslation(array $data): Translation;

    /**
     * @param string $code
     * @param string $language
     * @param array $data
     * @return Translation
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws BadRequestException
     */
    public function updateTranslation(string $code, string $language, array $data): Translation;

    /**
     * @param string $code
     * @param string $language
     * @return string[]
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws IntegrityException
     */
    public function deleteTranslation(string $code, string $language);

	/**
	 * @param Translation $translation
	 * @return array
	 */
	public function format(Translation $translation): array;

	/**
	 * @param Translation[] $translations
	 * @return array
	 */
	public function formatEntities(array $translations): array;
}
