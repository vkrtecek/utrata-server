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
use App\Model\Exception\AlreadyExistException;
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
	public function getPurposes(): array;

	/**
	 * @param string $code language code
	 * @return Purpose[]
	 * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function getLanguagePurposes(string $code): array;

	/**
	 * @param string $languageCode
	 * @return Purpose[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getLanguageBasePurposes(string $languageCode): array;

	/**
	 * @param Member $member
	 * @param string $languageCode
	 * @return Purpose[]
	 * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function getUserLanguagePurposes(Member $member, string $languageCode): array;

	/**
	 * @param Member $member
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getUserPurposes(Member $member): array;

	/**
	 * @param Member $member
	 * @return Purpose[]
	 */
	public function getPurposesCreatedByUser(Member $member): array;

    /**
     * @param int $id
     * @return Purpose
     * @throws BadParameterException
     * @throws NotFoundException
     */
    public function getPurpose(int $id): Purpose;

    /**
	 * @param Member $member
     * @param $data
     * @return Purpose
     * @throws BadRequestHttpException
	 * @throws AlreadyExistException
     * @throws NotFoundException
     */
    public function createPurpose(Member $member, array $data): Purpose;

    /**
     * @param int $id
     * @param $data
     * @return Purpose
     * @throws NotFoundException
     * @throws BadRequestHttpException
     * @throws BadParameterException
     */
    public function updatePurpose(int $id, array $data): Purpose;

    /**
     * @param int $id
	 * @param Member $member
     * @throws NotFoundException
     * @throws BadParameterException
     * @throws IntegrityException
     */
    public function deletePurpose(int $id, Member $member);

	/**
	 * @param Purpose $purpose
	 * @param Member $member
	 * @return array
	 */
	public function format(Purpose $purpose, Member $member): array;

	/**
	 * @param Purpose[] $purposes
	 * @param Member $member
	 * @return array
	 */
	public function formatEntities(array $purposes, Member $member): array;
}
