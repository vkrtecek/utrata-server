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
     * @return Language[]|NULL
     */
    public function findAll();

    /**
     * @param string $code
     * @return Language|NULL
     */
    public function findOne($code);

    /**
     * @param Language $language
     * @return Language
     */
    public function create(Language $language);

    /**
     * @param Language $language
     * @return Language
     */
    public function update(Language $language);

    /**
     * @param Language $language
     * @throws IntegrityException
     */
    public function delete(Language $language);
}