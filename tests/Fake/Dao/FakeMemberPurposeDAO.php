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
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
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

    /**
     * FakeMemberPurposeDAO constructor.
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function __construct() {
		$this->member = (new FakeMemberService())->getMember('vojta');
		$this->member2 = (new FakeMemberService())->getMember('jožka');

		$this->purpose = (new FakePurposeService())->getPurpose(1);
		$this->purpose2 = (new FakePurposeService())->getPurpose(2);
		$this->purpose3 = (new FakePurposeService())->getPurpose(3);
	}

	/**
     * @inheritdoc
     * @throws NotFoundException
     * @throws BadParameterException
     */
	public function find(Member $member, Purpose $purpose): ?MemberPurpose {
	    if ($purpose == (new FakePurposeService)->getPurpose(1) && $member == (new FakeMemberService)->getMember('vojta'))
	        return null;
		$mp = new MemberPurpose();
		$mp->setMember($member);
		$mp->setPurpose($purpose);
		return $mp;
	}

    /**
     * @inheritdoc
     * @throws NotFoundException
     * @throws BadParameterException
     */
    public function findPurposes(Member $member): array {
		if ($member->getLogin() == 'vojta')
			return [
				$this->find($this->member, $this->purpose),
				$this->find($this->member, $this->purpose2),
			];
		return [ $this->find($this->member2, $this->purpose3) ];
	}

    /**
     * @inheritdoc
     * @throws NotFoundException
     * @throws BadParameterException
     */
    public function create(Member $member, Purpose $purpose): MemberPurpose {
		return $this->find($this->member2, $purpose);
	}

    /** @inheritdoc */
    public function delete(Member $member, Purpose $purpose) {}
}
