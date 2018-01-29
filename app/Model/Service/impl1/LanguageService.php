<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 19:19
 */

namespace App\Model\Service;


use App\Model\Dao\LanguageDAO;
use App\Model\Entity\Language;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LanguageService implements ILanguageService
{
	/** @var LanguageDAO */
	protected $languageDao;

	/**
	 * LanguageService constructor.
	 * @param LanguageDAO $languageDAO
	 */
	public function __construct(LanguageDAO $languageDAO)
	{
		$this->languageDao = $languageDAO;
	}

	/**
	 * @return Language[]
	 * @throws NotFoundException
	 */
	public function getLanguages() {
		$languages = $this->languageDao->findAll();
		if ($languages == NULL)
			throw new NotFoundException('LanguageService: No language found.');
		return $languages;
	}

	/**
	 * @param string $code
	 * @return Language
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getLanguage($code) {
		if ($code == NULL || $code == "")
			throw new BadParameterException('LanguageService: Identifier "languageCode" not specified.');
		$language = $this->languageDao->findOne($code);
		if ($language == NULL)
			throw new NotFoundException('LanguageService: No language found.');
		return $language;
	}

	/**
	 * @param $data
	 * @return Language
	 * @throws AlreadyExistException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 */
	public function createLanguage($data) {
		$language = new Language();
		if (!isset($data['languageCode']))
			throw new BadParameterException('LanguageService: Identifier "languageCode" not specified');
		try {
			//throws NoFoundException
			$this->getLanguage($data['languageCode']);
			throw new AlreadyExistException('LanguageService: Language with this code already exists.');
		} catch (NotFoundException $ex) {
			$language->setCode($data['languageCode']);
			$this->setLanguage($language, $data);
			return $this->languageDao->create($language);
		}
	}

	/**
	 * @param string $code
	 * @param array $data
	 * @return Language
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 * @throws NotFoundException
	 */
	public function updateLanguage($code, $data) {
		try {
			$language = $this->getLanguage($code);
			$this->setLanguage($language, $data);
			return $this->languageDao->update($language);
		} catch (NotFoundException $ex) {
			throw new NotFoundException('LanguageService: No language with this code.', 0, $ex);
		}
	}

	/**
	 * @param string $code
	 * @return string
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws IntegrityException
	 */
	public function deleteLanguage($code) {
		try {
			//throws BadParameterException and NotFoundException
			$language = $this->getLanguage($code);
			$this->languageDao->delete($language);
			return $code;
		} catch (NotFoundException $ex) {
			throw new NotFoundException('LanguageService: No language with this code.', 0, $ex);
		}
	}

	/**
	 * @param Language $language
	 * @param $data
	 * @throws BadRequestHttpException
	 */
	protected function setLanguage(Language $language, $data) {
		if (!isset($data['name']) || $data['name'] == NULL)
			throw new BadRequestHttpException('LanguageService: "name" must be specified.');
		else
			$language->setName($data['name']);
	}

	/**
	 * @param Language $language
	 * @return array
	 */
	public function format(Language $language) {
		$ret = [];

		$ret['code'] = $language->getCode();
		$ret['name'] = $language->getName();

		return $ret;
	}

	/**
	 * @param Language[] $languages
	 * @return array
	 */
	public function formatEntites($languages) {
		$ret = [];
		foreach($languages as $language)
			$ret[] = $this->format($language);
		return $ret;
	}
}