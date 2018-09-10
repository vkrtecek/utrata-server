<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 3. 2. 2018
 * Time: 20:56
 */

namespace App\Model\Service;


use App\Model\Dao\IItemDAO;
use App\Model\Dao\IMemberPurposeDAO;
use App\Model\Dao\IPurposeDAO;
use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;
use App\Model\Exception\AlreadyExistException;
use App\Model\Filter\ItemFilter;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MemberPurposeService implements IMemberPurposeService
{

	/** @var IItemDAO */
	private $itemDao;

	/** @var IPurposeDAO */
	private $purposeDao;

	/** @var IMemberPurposeDAO */
	private $memberPurposeDao;

	/** @var ILanguageService */
	private $languageService;

	/**
	 * MemberPurposeService constructor.
	 * @param IMemberPurposeDAO $memberPurposeDAO
	 * @param IPurposeDAO $purposeDAO
	 * @param IItemDAO $itemDAO
	 * @param ILanguageService $languageService
	 */
	public function __construct(IMemberPurposeDAO $memberPurposeDAO, IPurposeDAO $purposeDAO, IItemDAO $itemDAO, ILanguageService $languageService) {
		$this->itemDao = $itemDAO;
		$this->purposeDao = $purposeDAO;
		$this->memberPurposeDao = $memberPurposeDAO;
		$this->languageService = $languageService;
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose
	 */
	public function create(Member $member, Purpose $purpose) {
		$already = $this->memberPurposeDao->find($member, $purpose);
		if ($already)
			return null;
		return $this->memberPurposeDao->create($member, $purpose);
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return void
	 * @throws BadRequestHttpException
	 */
	public function delete(Member $member, Purpose $purpose) {
		if (count($this->userItemsWithPurpose($member, $purpose)) == 0) {
			$this->memberPurposeDao->delete($member, $purpose);
		}
	}

	/**
	 * @param Member $member
	 * @return MemberPurpose[]
	 */
	public function getMemberPurposes(Member $member) {
		return $this->memberPurposeDao->findPurposes($member);
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose|NULL
	 */
	public function getMemberPurpose(Member $member, Purpose $purpose) {
		return $this->memberPurposeDao->find($member, $purpose);
	}

	/**
	 * @param Member $member
	 * @param string $ids ID of each purpose separated by comma
	 * @return void
	 * @throws NotFoundException
	 */
	public function setMemberPurposes(Member $member, $ids) {
		foreach (explode(',', $ids) as $id) {
			$purpose = $this->purposeDao->findOne($id);
		}
	}




	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return Item[]
	 */
	private function userItemsWithPurpose(Member $member, Purpose $purpose) {
		$filters = new ItemFilter();
		$filters->setNotes([ (string)$purpose->getId() ])->setMember($member);
		return $this->itemDao->findUsersItemsByNotes($filters);
	}
}
