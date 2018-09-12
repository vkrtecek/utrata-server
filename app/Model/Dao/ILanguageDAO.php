<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 19. 10. 2017
 * Time: 19:15
 */

namespace App\Model\Dao;


use App\Model\Entity\Language;
use App\Model\Exception\IntegrityException;

interface ILanguageDAO
{
    /**
     * @return Language[]
     */
    public function findAll(): array;

    /**
     * @param string $code
     * @return Language|NULL
     */
    public function findOne(string $code): ?Language;

    /**
     * @param Language $language
     * @return Language
     */
    public function create(Language $language): Language;

    /**
     * @param Language $language
     * @return Language
     */
    public function update(Language $language): Language;

    /**
     * @param Language $language
     * @throws IntegrityException
     */
    public function delete(Language $language);
}
