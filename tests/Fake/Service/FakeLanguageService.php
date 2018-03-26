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
	/** @var Language */
	private $language;

	public function __construct() {
		$this->language = new Language();
		$this->language->setCode('CZK');
		$this->language->setName('Česky');
	}

	/**
	 * @return Language[]
	 * @throws NotFoundException
	 */
	public function getLanguages() {
		return [ $this->language ];
	}

	/**
	 * @param string $code
	 * @return Language
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getLanguage($code) {
		$this->language->setCode($code);
		return $this->language;
	}

	/**
	 * @param $data
	 * @return Language
	 * @throws AlreadyExistException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function createLanguage($data) {
		return $this->language;
	}

	/**
	 * @param string $code
	 * @param $data
	 * @return Language
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 */
	public function updateLanguage($code, $data) {
		return $this->language;
	}

	/**
	 * @param string $code
	 * @return string
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws IntegrityException
	 */
	public function deleteLanguage($code) {
		return $code;
	}

	/**
	 * @param Language $language
	 * @return array
	 */
	public function format(Language $language) {
		return [];
	}

	/**
	 * @param Language[] $languages
	 * @return array
	 */
	public function formatEntites($languages) {
		return [];
	}
}