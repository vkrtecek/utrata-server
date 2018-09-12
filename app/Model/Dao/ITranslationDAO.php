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
     * @return Translation[]
     */
    public function findAll(): array;

    /**
     * @param string $code
     * @param Language $language
     * @return Translation|NULL
     */
    public function findOne(string $code, Language $language): ?Translation;

	/**
	 * @param Language $language
	 * @return Translation[]
	 */
	public function findAllByLanguage(Language $language): array;

    /**
     * @param Translation $translation
     * @return Translation
     */
    public function create(Translation $translation): Translation;

    /**
     * @param Translation $translation
     * @return Translation
     */
    public function update(Translation $translation): Translation;

    /**
     * @param Translation $translation
     * @throws IntegrityException
     */
    public function delete(Translation $translation);

}
