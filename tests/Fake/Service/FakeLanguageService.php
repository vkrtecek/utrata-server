<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:45
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Language;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\ILanguageService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FakeLanguageService implements ILanguageService
{
	/**
	 * @return Language[]
	 * @throws NotFoundException
	 */
	public function getLanguages() {}

	/**
	 * @param string $code
	 * @return Language
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getLanguage($code) {
		$l = new Language();
		$l->setCode($code);
		return $l;
	}

	/**
	 * @param $data
	 * @return Language
	 * @throws AlreadyExistException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function createLanguage($data) {}

	/**
	 * @param string $code
	 * @param $data
	 * @return Language
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 */
	public function updateLanguage($code, $data) {}

	/**
	 * @param string $code
	 * @return string
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws IntegrityException
	 */
	public function deleteLanguage($code) {}

	/**
	 * @param Language $language
	 * @return array
	 */
	public function format(Language $language) {}

	/**
	 * @param Language[] $languages
	 * @return array
	 */
	public function formatEntites($languages) {}
}