<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:45
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Language;
use App\Model\Service\ILanguageService;

class FakeLanguageService implements ILanguageService
{
	/** @var Language */
	private $language;

	public function __construct() {
		$this->language = new Language();
		$this->language->setCode('CZK');
		$this->language->setName('Česky');
	}

	/** @inheritdoc */
    public function getLanguages(): array {
		return [ $this->language ];
	}

    /** @inheritdoc */
    public function getLanguage(string $code): Language {
		$this->language->setCode($code);
		return $this->language;
	}

    /** @inheritdoc */
    public function createLanguage(array $data): Language {
		return $this->language;
	}

    /** @inheritdoc */
    public function updateLanguage(string $code, array $data): Language {
		return $this->language;
	}

    /** @inheritdoc */
    public function deleteLanguage(string $code) {
		return $code;
	}

    /** @inheritdoc */
    public function format(Language $language): array {
		return [];
	}

    /** @inheritdoc */
    public function formatEntites(array $languages): array {
		return [];
	}
}
