<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 16. 11. 2017
 * Time: 2:03
 */

namespace App\Model\Service;


use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface IPurposeService
{
	/**
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getPurposes();

	/**
	 * @param string $code language code
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getLanguagePurposes($code);

	/**
	 * @param string $login
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getUserPurposes($login);

    /**
     * @param int $id
     * @return Purpose
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function getPurpose($id);

    /**
	 * @param Member $member
     * @param $data
     * @return Purpose
     * @throws BadRequestHttpException
	 * @throws AlreadyExistException
     */
    public function createPurpose(Member $member, $data);

    /**
     * @param int $id
     * @param $data
     * @return Purpose
     * @throws NotFoundException
     * @throws BadRequestHttpException
     * @throws BadParameterException
     */
    public function updatePurpose($id, $data);

    /**
     * @param int $id
     * @return int
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws IntegrityException
     */
    public function deletePurpose($id);

	/**
	 * @param Purpose $purpose
	 * @return array
	 */
	public static function format(Purpose $purpose);

	/**
	 * @param Purpose[] $purposes
	 * @return array
	 */
	public static function formatEntites($purposes);
}