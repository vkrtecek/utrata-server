<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 19. 10. 2017
 * Time: 19:21
 */

namespace App\Model\Service;


use App\Model\Entity\Language;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface ILanguageService
{
    /**
     * @return Language[]
     * @throws NotFoundException
     */
    public function getLanguages();

    /**
     * @param string $code
     * @return Language
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function getLanguage($code);

    /**
     * @param $data
     * @return Language
     * @throws AlreadyExistException
     * @throws BadParameterException
     * @throws BadRequestHttpException
     */
    public function createLanguage($data);

    /**
     * @param string $code
     * @param $data
     * @return Language
     * @throws BadParameterException
     * @throws NotFoundException
     * @throws BadRequestHttpException
     */
    public function updateLanguage($code, $data);

    /**
     * @param string $code
     * @return string
     * @throws BadParameterException
     * @throws NotFoundException
     * @throws IntegrityException
     */
    public function deleteLanguage($code);

	/**
	 * @param Language $language
	 * @return array
	 */
	public function format(Language $language);

	/**
	 * @param Language[] $languages
	 * @return array
	 */
	public function formatEntites($languages);
}