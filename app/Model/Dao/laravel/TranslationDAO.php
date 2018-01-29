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
use App\Model\Exception\IntegrityException;

class TranslationDAO implements ITranslationDAO
{

    /**
     * @return Translation[]|NULL
     */
    public function findAll() {
        return Translation::all();
    }

    /**
     * @param string $code
     * @param Language $language
     * @return Translation|NULL
     */
    public function findOne($code, Language $language) {
    	return Translation::where('code', $code)
			->andWhere('LanguageCode', $language->getCode())
			->first();
    }

	/**
	 * @param Language $language
	 * @return Translation[]|NULL
	 */
	public function findAllByLanguage(Language $language) {
		return Translation::where('LanguageCode', $language->getCode())->get();
	}

    /**
     * @param Translation $translation
     * @return Translation
     */
    public function create(Translation $translation) {
        $translation->save();
        return $translation;
    }

    /**
     * @param Translation $translation
     * @return Translation
     */
    public function update(Translation $translation) {
        $translation->save();
        return $translation;
    }

    /**
     * @param Translation $translation
     * @throws IntegrityException
     */
    public function delete(Translation $translation){
        try {
            $translation->delete();
        } catch (\Exception $ex) {
            throw new IntegrityException('Cannot remove couse of FK. ' . $ex->getMessage(), 0, $ex);
        }
    }
}