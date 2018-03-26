<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:15
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\IMemberPurposeDAO;
use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;
use Tests\Fake\Service\FakeMemberService;
use Tests\Fake\Service\FakePurposeService;

class FakeMemberPurposeDAO implements IMemberPurposeDAO
{
	/** @var Member */
	private $member;
	/** @var Member */
	private $member2;

	/** @var Purpose */
	private $purpose;
	/** @var Purpose */
	private $purpose2;
	/** @var Purpose */
	private $purpose3;

	public function __construct() {
		$this->member = (new FakeMemberService())->getMember('vojta');
		$this->member2 = (new FakeMemberService())->getMember('jožka');

		$this->purpose = (new FakePurposeService())->getPurpose(1);
		$this->purpose2 = (new FakePurposeService())->getPurpose(2);
		$this->purpose3 = (new FakePurposeService())->getPurpose(3);
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose|NULL
	 */
	public function find(Member $member, Purpose $purpose) {
		$mp = new MemberPurpose();
		$mp->setMember($member);
		$mp->setPurpose($purpose);
		return $mp;
	}

	/**
	 * @param Member $member
	 * @return MemberPurpose[]
	 */
	public function findPurposes(Member $member) {
		if ($member->getLogin() == 'vojta')
			return [
				$this->find($this->member, $this->purpose),
				$this->find($this->member, $this->purpose2),
			];
		return $this->find($this->member2, $this->purpose3);
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose
	 */
	public function create(Member $member, Purpose $purpose) {
		return $this->find($member, $purpose);
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return void
	 */
	public function delete(Member $member, Purpose $purpose) {}
}