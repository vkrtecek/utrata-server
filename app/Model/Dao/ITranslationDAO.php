<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 16. 11. 2017
 * Time: 15:38
 */

namespace App\Model\Dao;


use App\Model\Entity\Language;
use App\Model\Entity\Translation;
use App\Model\Exception\IntegrityException;

interface ITranslationDAO
{
    /**
     * @return Translation[]|NULL
     */
    public function findAll();

    /**
     * @param string $code
     * @param Language $language
     * @return Translation|NULL
     */
    public function findOne($code, Language $language);

	/**
	 * @param Language $language
	 * @return Translation[]|NULL
	 */
	public function findAllByLanguage(Language $language);

    /**
     * @param Translation $translation
     * @return Translation
     */
    public function create(Translation $translation);

    /**
     * @param Translation $translation
     * @return Translation
     */
    public function update(Translation $translation);

    /**
     * @param Translation $translation
     * @throws IntegrityException
     */
    public function delete(Translation $translation);

}