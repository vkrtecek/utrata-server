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
use App\Model\Service\ITranslationService;

class FakeTranslationService implements ITranslationService
{
    /** @var Translation  */
    protected $translation;

    /**
     * FakeTranslationService constructor.
     */
    public function __construct() {
        $this->translation = (new Translation)->setCode('Code')->setValue('Toto je překlad');
    }

    /** @inheritdoc */
    public function getTranslations(): array {
        return [];
    }

    /** @inheritdoc */
    public function getTranslationsByLanguage(string $languageCode): array {
        return [];
    }

    /** @inheritdoc */
    public function getTranslation(string $code, string $language, string $default = ''): Translation {
        return $this->translation;
    }

    /** @inheritdoc */
    public function getTranslationDefault(string $code, Language $language, string $default = ''): string {
        return $this->translation->getValue();
    }

    /** @inheritdoc */
    public function get(string $code, string $default = ''): string {
        return $this->translation->getValue();
    }

    /** @inheritdoc */
    public function createTranslation(array $data): Translation {
        return $this->translation;
    }

    /** @inheritdoc */
    public function updateTranslation(string $code, string $language, array $data): Translation {
        return $this->translation;
    }

    /** @inheritdoc */
    public function deleteTranslation(string $code, string $language) {}

    /** @inheritdoc */
    public function format(Translation $translation): array {
        return [];
    }

    /** @inheritdoc */
    public function formatEntities(array $translations): array {
        return [];
    }
}
