<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:14
 */

namespace Tests\Unit;


use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;
use App\Model\Exception\AuthenticationException;
use App\Model\Service\MemberPurposeService;
use Tests\Fake\Dao\FakeItemDAO;
use Tests\Fake\Dao\FakeMemberPurposeDAO;
use Tests\Fake\Dao\FakePurposeDAO;
use Tests\Fake\Service\FakeLanguageService;
use Tests\Fake\Service\FakeMemberService;
use Tests\Fake\Service\FakePurposeService;
use Tests\TestCase;

class MemberPurposeTest extends TestCase
{
	/** @var MemberPurposeService */
	private $memberPurposeService;

	/** @var Member */
	private $member;
	/** @var Member */
	private $member2;

	/** @var Purpose */
	private $purpose;

    /**
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     * @throws AuthenticationException
     */
	protected function setUp() {
		parent::setUp();
		$this->memberPurposeService = new MemberPurposeService(
			new FakeMemberPurposeDAO(),
			new FakePurposeDAO(),
			new FakeItemDAO(),
			new FakeLanguageService()
		);
		$this->member = (new FakeMemberService())->getMember('vojta');
		$this->member2 = (new FakeMemberService())->getMember('jožka');
		$this->purpose = (new FakePurposeService())->getPurpose(1);
	}

    /**
     *
     */
	public function testCreate() {
		$mp = $this->memberPurposeService->create($this->member, $this->purpose);

		$this->assertTrue($mp instanceof MemberPurpose);
		$this->assertEquals($this->member2, $mp->getMember());
		$this->assertEquals($this->purpose, $mp->getPurpose());
	}

    /**
     *
     */
	public function testGetMemberPurposes() {
		$mps = $this->memberPurposeService->getMemberPurposes($this->member);
		$this->assertEquals(2, count($mps));

		$mps = $this->memberPurposeService->getMemberPurposes($this->member2);
		$this->assertEquals(1, count($mps));
	}
}
