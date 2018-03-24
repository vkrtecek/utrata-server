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
use App\Model\Service\IMemberPurposeService;

class FakeMemberPurposeService implements IMemberPurposeService
{
	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose
	 */
	public function create(Member $member, Purpose $purpose) {}

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
	public function getMemberPurposes(Member $member) {}
}