<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 28. 1. 2018
 * Time: 19:14
 */

namespace App\Model\Service;


use App\Model\Dao\ITranslationDAO;
use App\Model\Entity\Language;
use App\Model\Entity\Translation;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\NotFoundException;
use Illuminate\Support\Facades\Auth;

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

	/** @inheritdoc */
	public function getTranslations(): array {
		$translations = $this->translationDao->findAll();
		if (count($translations) == 0)
			throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Translation']);
		return $translations;
	}

    /** @inheritdoc */
    public function getTranslationsByLanguage(string $languageCode): array {
		if (!$languageCode || $languageCode == "")
			throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'language']);
		$language = $this->languageService->getLanguage($languageCode);
		$translations = $this->translationDao->findAllByLanguage($language);
		if ($translations == NULL)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Translation']);
		return $translations;
	}

    /** @inheritdoc */
    public function getTranslation(string $code, string $languageCode, string $default = ''): Translation {
		if (empty($code) || empty($languageCode))
            throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'code or language']);
		$language = $this->languageService->getLanguage($languageCode);
		$translation = $this->translationDao->findOne($code, $language);
		if ($translation == NULL) {
			$translation = new Translation();
			$translation->setValue($default);
		}
		return $translation;
	}

    /** @inheritdoc */
    public function getTranslationDefault(string $code, Language $language, string $default = ''): string {
		return $this->getTranslation($code, $language->getCode(), $default)->getValue();
	}

    /** @inheritdoc */
    public function get(string $code, string $default = ''): string {
		$language = Auth::user() ? Auth::user()->getLanguage()->getCode() : 'CZK';
		return $this->getTranslation($code, $language, $default)->getValue();
	}

    /** @inheritdoc */
    public function createTranslation(array $data): Translation {
		$translation = new Translation();
		if (!isset($data['code']) || !isset($data['language']))
            throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'code or language']);
		try {
			$this->getTranslation($data['code'], $data['language']);
			throw (new AlreadyExistException('Exception.AlreadyExists', ':entity with this :parameter already exists'))->setBind(['parameter' => 'code and language']);
		} catch (NotFoundException $ex) {
			$translation->setCode($data['code']);
			$language = $this->languageService->getLanguage($data['language']);
			$translation->setLanguage($language);
			$this->setTranslation($translation, $data);
			return $this->translationDao->create($translation);
		}
	}

    /** @inheritdoc */
    public function updateTranslation(string $code, string $language, array $data): Translation {
		try {
			$translation = $this->getTranslation($code, $language);
			$this->setTranslation($translation, $data);
			return $this->translationDao->update($translation);
		} catch (NotFoundException $ex) {
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Translation']);
		}
	}

    /** @inheritdoc */
    public function deleteTranslation(string $code, string $language) {
		try {
			$translation = $this->getTranslation($code, $language);
			$this->translationDao->delete($translation);
			return array($code, $language);
		} catch (NotFoundException $ex) {
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Translation']);
		}
	}

    /** @inheritdoc */
    public function format(Translation $translation): array {
		$ret = [];

		$ret['code'] = $translation->getCode();
		$ret['value'] = $translation->getValue();
		$ret['languageCode'] = $translation->getLanguage()->getCode();

		return $ret;
	}

    /** @inheritdoc */
    public function formatEntities(array $translations): array {
		$ret = [];
		foreach($translations as $translation)
			$ret[] = $this->format($translation);
		return $ret;
	}

    /**
     * @param Translation $entity
     * @param array $data
     * @throws BadRequestException
     */
    protected function setTranslation(Translation $entity, $data) {
        if (!isset($data['value']))
            throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'value']);
        else
            $entity->setValue($data['value']);
    }
}
