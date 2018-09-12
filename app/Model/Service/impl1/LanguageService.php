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
use App\Model\Exception\BadRequestException;
use App\Model\Exception\NotFoundException;

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

	/** @inheritdoc */
	public function getLanguages(): array {
		$languages = $this->languageDao->findAll();
		if (!count($languages))
			throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Language']);
		return $languages;
	}

    /** @inheritdoc */
    public function getLanguage(string $code): Language {
		if (empty($code))
			throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'languageCode']);
		$language = $this->languageDao->findOne($code);
		if ($language == NULL)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Language']);
		return $language;
	}

    /** @inheritdoc */
    public function createLanguage(array $data): Language {
		$language = new Language();
		if (!isset($data['languageCode']))
            throw (new BadParameterException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'languageCode']);
		try {
			//throws NoFoundException
			$this->getLanguage($data['languageCode']);
			throw (new AlreadyExistException('Exception.AlreadyExists', ':entity with this :parameter already exists'))->setBind(['entity' => 'Language', 'parameter' => 'code']);
		} catch (NotFoundException $ex) {
			$language->setCode($data['languageCode']);
			$this->setLanguage($language, $data);
			return $this->languageDao->create($language);
		}
	}

    /** @inheritdoc */
    public function updateLanguage(string $code, array $data): Language {
		try {
			$language = $this->getLanguage($code);
			$this->setLanguage($language, $data);
			return $this->languageDao->update($language);
		} catch (NotFoundException $ex) {
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Language']);
		}
	}

    /** @inheritdoc */
    public function deleteLanguage(string $code) {
		try {
			//throws BadParameterException and NotFoundException
			$language = $this->getLanguage($code);
			$this->languageDao->delete($language);
			return $code;
		} catch (NotFoundException $ex) {
            throw (new NotFoundException('Exception.NotFound', 'No :entity found'))->setBind(['entity' => 'Language']);
		}
	}

    /** @inheritdoc */
    public function format(Language $language): array {
		$ret = [];

		$ret['code'] = $language->getCode();
		$ret['name'] = $language->getName();

		return $ret;
	}

    /** @inheritdoc */
    public function formatEntites(array $languages): array {
		$ret = [];
		foreach($languages as $language)
			$ret[] = $this->format($language);
		return $ret;
	}

    /**
     * @param Language $language
     * @param array $data
     * @throws BadRequestException
     */
    protected function setLanguage(Language $language, array $data) {
        if (!isset($data['name']))
            throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'name']);
        $language->setName($data['name']);
    }
}
