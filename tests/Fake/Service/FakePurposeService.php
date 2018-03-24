<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:48
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IPurposeService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FakePurposeService implements IPurposeService
{
	/**
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getPurposes() {}

	/**
	 * @param string $code language code
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getLanguagePurposes($code) {}

	/**
	 * @param string $languageCode
	 * @return Purpose[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getLanguageBasePurposes($languageCode) {
		return [];
	}

	/**
	 * @param Member $member
	 * @param string $languageCode
	 * @return Purpose[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getUserLanguagePurposes(Member $member, $languageCode) {}

	/**
	 * @param Member $member
	 * @return Purpose[]
	 * @throws NotFoundException
	 */
	public function getUserPurposes(Member $member) {}

	/**
	 * @param int $id
	 * @return Purpose
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getPurpose($id) {}

	/**
	 * @param Member $member
	 * @param $data
	 * @return Purpose
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 */
	public function createPurpose(Member $member, $data) {}

	/**
	 * @param int $id
	 * @param $data
	 * @return Purpose
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 */
	public function updatePurpose($id, $data) {}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deletePurpose($id) {}

	/**
	 * @param Purpose $purpose
	 * @return array
	 */
	public function format(Purpose $purpose) {}

	/**
	 * @param Purpose[] $purposes
	 * @return array
	 */
	public function formatEntities($purposes) {}
}