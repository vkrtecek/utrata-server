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
use Tests\Fake\Dao\FakePurposeDAO;

class FakePurposeService implements IPurposeService
{
	/** @var FakePurposeDAO */
	protected $purposeDao;

	/**
	 * FakePurposeService constructor.
	 */
	public function __construct() {
		$this->purposeDao = new FakePurposeDAO();
	}

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
	 * @param Member $member
	 * @return Purpose[]
	 */
	public function getPurposesCreatedByUser(Member $member) {}

	/**
	 * @param int $id
	 * @return Purpose
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getPurpose($id) {
		return $this->purposeDao->findOne($id);
	}

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
	 * @param Member $member
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deletePurpose($id, Member $member) {}

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