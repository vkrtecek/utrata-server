<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 19:14
 */

namespace App\Model\Service;


use App\Model\Dao\ITranslationDAO;
use App\Model\Entity\Translation;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TranslationService implements ITranslationService
{
	/** @var ITranslationDAO */
	protected $translationDao;

	/** @var ILanguageService */
	protected $languageService;

	/**
	 * TranslationService constructor.
	 * @param ITranslationDAO $translationDao
	 * @param ILanguageService $languageService
	 */
	public function __construct(ITranslationDAO $translationDao, ILanguageService $languageService)
	{
		$this->translationDao = $translationDao;
		$this->languageService = $languageService;
	}

	/**
	 * @return Translation[]
	 * @throws NotFoundException
	 */
	public function getTranslations() {
		$translations = $this->translationDao->findAll();
		if ($translations == NULL)
			throw new NotFoundException('TranslationService: No Translation found.');
		return $translations;
	}

	/**
	 * @param string $languageCode
	 * @return Translation[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getTranslationsByLanguage($languageCode) {
		if (!$languageCode || $languageCode == "")
			throw new BadParameterException('TranslationService: Identifier "language" not specified.');
		$language = $this->languageService->getLanguage($languageCode);
		$translations = $this->translationDao->findAllByLanguage($language);
		if ($translations == NULL)
			throw new NotFoundException('TranslationService: No Translation for this language found.');
		return $translations;
	}

	/**
	 * @param string $code
	 * @param string $languageCode
	 * @return Translation
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getTranslation($code, $languageCode) {
		if ($code == NULL || $code == "" || $languageCode == NULL || $languageCode == "")
			throw new BadParameterException('TranslationService: Identifier "code" or "language" not specified.');
		$language = $this->languageService->getLanguage($languageCode);
		$translation = $this->translationDao->findOne($code, $language);
		if ($translation == NULL)
			throw new NotFoundException('TranslationService: No Translation found.');
		return $translation;
	}

	/**
	 * @param $data
	 * @return Translation
	 * @throws AlreadyExistException
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function createTranslation($data) {
		$translation = new Translation();
		if (!isset($data['code']) || !isset($data['language']))
			throw new BadParameterException('TranslationService: Identifier "code" or "language" not specified.');
		try {
			$this->getTranslation($data['code'], $data['language']);
			throw new AlreadyExistException('TranslationService: Translation with this code and language already exists.');
		} catch (NotFoundException $ex) {
			$translation->setCode($data['code']);
			$language = $this->languageService->getLanguage($data['language']);
			$translation->setLanguage($language);
			$this->setTranslation($translation, $data);
			return $this->translationDao->create($translation);
		}
	}

	/**
	 * @param string $code
	 * @param string $language
	 * @param $data
	 * @return Translation
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateTranslation($code, $language, $data) {
		try {
			$translation = $this->getTranslation($code, $language);
			$this->setTranslation($translation, $data);
			return $this->translationDao->update($translation);
		} catch (NotFoundException $ex) {
			throw new NotFoundException('TranslationService: No Translation with this code and language', 0, $ex);
		}
	}

	/**
	 * @param string $code
	 * @param string $language
	 * @return string[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteTranslation($code, $language) {
		try {
			$translation = $this->getTranslation($code, $language);
			$this->translationDao->delete($translation);
			return array($code, $language);
		} catch (NotFoundException $ex) {
			throw new NotFoundException('TranslationSerice: No Transaltion with given "code" and "language"', 0, $ex);
		}
	}

	/**
	 * @param Translation $entity
	 * @param $data
	 * @throws BadRequestHttpException
	 */
	protected function setTranslation(Translation $entity, $data) {
		if (!isset($data['value']) || $data['value'] == NULL)
			throw new BadRequestHttpException('TranslationSerice: "value" must be specified.');
		else
			$entity->setValue($data['value']);
	}

	/**
	 * @param Translation $translation
	 * @return array
	 */
	public function format(Translation $translation) {
		$ret = [];

		$ret['code'] = $translation->getCode();
		$ret['value'] = $translation->getValue();
		$ret['languageCode'] = $translation->getLanguage()->getCode();

		return $ret;
	}

	/**
	 * @param Translation[] $translations
	 * @return array
	 */
	public function formatEntites($translations) {
		$ret = [];
		foreach($translations as $translation)
			$ret[] = $this->format($translation);
		return $ret;
	}
}