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
	/** @var MemberPurpose */
	protected $mp1;

    /**
     * FakeMemberPurposeService constructor.
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function __construct() {
		$this->mp1 = new MemberPurpose();
		$this->mp1->setPurpose((new FakePurposeService())->getPurpose(1));
	}

    /** @inheritdoc */
    public function create(Member $member, Purpose $purpose): ?MemberPurpose {
		$this->mp1->setMember($member);
		return $this->mp1;
	}

    /** @inheritdoc */
    public function delete(Member $member, Purpose $purpose) {}

    /** @inheritdoc */
    public function getMemberPurposes(Member $member): array {
		$this->mp1->setMember($member);
		return [ $this->mp1 ];
	}

    /** @inheritdoc */
    public function getMemberPurpose(Member $member, Purpose $purpose): MemberPurpose {
		$this->mp1->setMember($member);
		return $this->mp1;
	}

    /** @inheritdoc */
    public function setMemberPurposes(Member $member, $ids) {

	}
}
