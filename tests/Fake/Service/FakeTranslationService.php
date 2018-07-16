<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:35
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Language;
use App\Model\Entity\Translation;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ITranslationService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FakeTranslationService implements ITranslationService
{
	/**
	 * @return Translation[]
	 * @throws NotFoundException
	 */
	public function getTranslations() {}

	/**
	 * @param string $languageCode
	 * @return Translation[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getTranslationsByLanguage($languageCode) {}

	/**
	 * @param string $code
	 * @param string $language
	 * @param string $default
	 * @return Translation
	 * @throws BadParameterException
	 */
	public function getTranslation($code, $language, $default = '') {}

	/**
	 * @param string $code
	 * @param Language $language
	 * @param string $default
	 * @return string
	 * @throws BadParameterException
	 */
	public function getTranslationDefault($code, Language $language, $default = '') {}

	/**
	 * @param string $code
	 * @param string $default
	 * @return string
	 */
	public function get($code, $default = '') {}

	/**
	 * @param $data
	 * @return Translation
	 * @throws AlreadyExistException
	 * @throws BadRequestHttpException
	 * @throws NotFoundException
	 */
	public function createTranslation($data) {}

	/**
	 * @param string $code
	 * @param string $language
	 * @param $data
	 * @return Translation
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateTranslation($code, $language, $data) {}

	/**
	 * @param string $code
	 * @param string $language
	 * @return string[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteTranslation($code, $language) {}

	/**
	 * @param Translation $translation
	 * @return array
	 */
	public function format(Translation $translation) {}

	/**
	 * @param Translation[] $translations
	 * @return array
	 */
	public function formatEntites($translations) {}
}