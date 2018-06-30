<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:49
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IMemberPurposeService;

class FakeMemberPurposeService implements IMemberPurposeService
{
	/** @var MemberPurpose */
	protected $mp1;

	/**
	 * FakeMemberPurposeService constructor.
	 */
	public function __construct() {
		$this->mp1 = new MemberPurpose();
		$this->mp1->setPurpose((new FakePurposeService())->getPurpose(1));
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose
	 */
	public function create(Member $member, Purpose $purpose) {
		$this->mp1->setMember($member);
		return $this->mp1;
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return void
	 */
	public function delete(Member $member, Purpose $purpose) {}

	/**
	 * @param Member $member
	 * @return MemberPurpose[]
	 */
	public function getMemberPurposes(Member $member) {
		$this->mp1->setMember($member);
		return [ $this->mp1 ];
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose|NULL
	 */
	public function getMemberPurpose(Member $member, Purpose $purpose) {
		$this->mp1->setMember($member);
		return $this->mp1;
	}

	/**
	 * @param Member $member
	 * @param string $ids ID of each purpose separated by comma
	 * @return void
	 * @throws NotFoundException
	 */
	public function setMemberPurposes(Member $member, $ids){

	}
}