<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 16. 11. 2017
 * Time: 15:39
 */

namespace App\Model\Dao;


use App\Model\Entity\Language;
use App\Model\Entity\Translation;

class TranslationDAO extends AbstractDAO implements ITranslationDAO
{

    /** @inheritdoc */
    public function findAll(): array {
        return $this->convertToArray(Translation::all());
    }

    /** @inheritdoc */
    public function findOne(string $code, Language $language): ?Translation {
    	return Translation::where('TranslationCode', $code)
			->where('LanguageCode', $language->getCode())
			->first();
    }

    /** @inheritdoc */
    public function findAllByLanguage(Language $language): array {
		return $this->convertToArray(Translation::where('LanguageCode', $language->getCode())->get());
	}

    /** @inheritdoc */
    public function create(Translation $translation): Translation {
        $translation->save();
        return $translation;
    }

    /** @inheritdoc */
    public function update(Translation $translation): Translation {
        $translation->save();
        return $translation;
    }

    /** @inheritdoc */
    public function delete(Translation $translation){
        $translation->delete();
    }
}
