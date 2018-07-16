<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 19. 10. 2017
 * Time: 19:18
 */

namespace App\Model\Dao;


use App\Model\Entity\Language;
use App\Model\Exception\IntegrityException;

class LanguageDAO implements ILanguageDAO
{

    /**
     * @return Language[]|NULL
     */
    public function findAll(){
        return Language::all();
    }

    /**
     * @param string $code
     * @return Language|NULL
     */
    public function findOne($code){
    	$l = Language::find($code);
		return $l;
    }

    /**
     * @param Language $language
     * @return Language
     */
    public function create(Language $language) {
        $language->save();
        return $language;
    }

    /**
     * @param Language $language
     * @return Language
     */
    public function update(Language $language) {
        $language->save();
        return $language;
    }

    /**
     * @param Language $language
     * @throws IntegrityException
     */
    public function delete(Language $language) {
        try {
            $language->delete();
        } catch (\Exception $ex) {
            //FK key violation
            throw new IntegrityException($ex->getMessage(), 0, $ex);
        }
    }

}