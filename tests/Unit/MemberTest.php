<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:32
 */

namespace Tests\Unit;


use App\Model\Entity\Member;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\MemberService;
use Tests\Fake\Dao\FakeMemberDAO;
use Tests\Fake\Service\FakeCurrencyService;
use Tests\Fake\Service\FakeLanguageService;
use Tests\Fake\Service\FakeMemberPurposeService;
use Tests\Fake\Service\FakePurposeService;
use Tests\Fake\Service\FakeTranslationService;
use Tests\TestCase;

class MemberTest extends TestCase
{
	/** @var MemberService */
	private $memberService;

    /**
     * @throws BadParameterException
     * @throws NotFoundException
     */
	protected function setUp() {
		parent::setUp();
		$this->memberService = new MemberService(
			(new FakeMemberDAO()),
			(new FakeLanguageService()),
			(new FakeCurrencyService()),
			(new FakePurposeService()),
			(new FakeMemberPurposeService()),
			(new FakeTranslationService())
		);
	}


    /**
     * @throws NotFoundException
     */
	public function testGetMember() {
		$member = $this->memberService->getMember('vojta');
		$this->assertTrue($member instanceof Member);
		$this->assertEquals('vojta', $member->getLogin());

		$member2 = $this->memberService->getMember('krtek');
		$this->assertTrue($member instanceof Member);
		$this->assertNotEquals($member, $member2);

		$this->expectException(NotFoundException::class);
		$this->memberService->getMember('asdadad');
	}

    /**
     * @throws BadParameterException
     * @throws NotFoundException
     */
	public function testGetByColumnBadColumn() {
		$this->expectException(BadParameterException::class);
		$this->memberService->getMemberByColumn('bad column', 'ahoj');
	}

    /**
     * @throws BadParameterException
     * @throws NotFoundException
     */
	public function testGetByColumnNoMember() {
		$this->expectException(NotFoundException::class);
		$this->memberService->getMemberByColumn('login', 'ahoj');
	}

    /**
     * @throws BadParameterException
     * @throws NotFoundException
     * @depends testGetByColumnBadColumn
     * @depends testGetByColumnNoMember
     */
	public function testGetByColumn() {
		$member = $this->memberService->getMemberByColumn('login', 'vojta');
		$expectedMember = $this->memberService->getMember('vojta');

		$this->assertEquals($expectedMember, $member);
		$this->assertTrue($member instanceof Member);
		$this->assertEquals('vojta', $member->getLogin());
		$this->assertEquals('Štěpán', $member->getFirstName());
		$this->assertEquals('Krteček', $member->getLastName());
	}

    /**
     * @throws BadParameterException
     * @throws NotFoundException
     * @depends testGetByColumn
     */
	public function testGetByToken() {
		$token = 'dome token';
		$member = $this->memberService->getByToken($token);
		$memberExpect = $this->memberService->getMemberByColumn('token', $token);
		$this->assertEquals($memberExpect, $member);
	}


//	public function testCreateMember() {}
//
//	public function testUpdateMember() {}
//
//	public function testLogin() {}
//
//	public function testLoginByFacebook() {}
//
//	public function testLogout() {}

    /**
     * @throws NotFoundException
     * @depends testGetMember
     */
	public function testFormat() {
		$member = $this->memberService->getMember('vojta');
		$formatted = $this->memberService->format($member);
		$expected = [
			'id' => 1,
			'firstName' => 'Štěpán',
			'lastName' => 'Krteček',
			'login' => 'vojta',
			'sendMonthly' => FALSE,
			'sendByOne' => NULL,
			'me' => 'example123@mail.com',
			'token' => 'some token',
			'facebook' => FALSE,
			'languageCode' => 'CZK',
			'currencyCode' => NULL,
			'lastLogged' => '2018-03-29 12:07:23',
			'notes' => [
				[]
			],
			'external' => FALSE,
		];
		$this->assertEquals($expected, $formatted);
	}


    /**
     * @throws BadParameterException
     * @throws NotFoundException
     * @throws \App\Model\Exception\AlreadyExistException
     * @throws \App\Model\Exception\AuthenticationException
     * @throws \App\Model\Exception\BadRequestException
     * @depends testGetMember
     */
	public function testInteractWithFacebook()
	{
		$data = [
			'login' => '123456789', //login exists
		];
		$member = $this->memberService->interactWithFacebook($data);
		$this->assertEquals('John', $member->getFirstName());
		$this->assertEquals('Doe', $member->getLastName());
		$this->assertEquals('123456789', $member->getLogin());



		$data = [
			'fname' => 'John',
			'lname' => 'Doe',
			'login' => '123456788', //login not exists
			'email' => 'some@example.com', //change also in FakeMemberDAO
			'locale' => 'en_EN',
		];
		$member = $this->memberService->interactWithFacebook($data);
		$this->assertEquals('John', $member->getFirstName());
		$this->assertEquals('Doe', $member->getLastName());
		$this->assertEquals('123456788', $member->getLogin());
		$this->assertEquals(MemberService::defaultEmail, $member->getMyMail());
		$this->assertEquals('EUR', $member->getCurrency()->getCode());
		$this->assertEquals('ENG', $member->getLanguage()->getCode());
		$this->assertTrue($member->isFacebook());
	}

    /**
     * @throws BadParameterException
     * @throws NotFoundException
     * @throws \App\Model\Exception\AlreadyExistException
     * @throws \App\Model\Exception\AuthenticationException
     * @throws \App\Model\Exception\BadRequestException
     * @depends testGetMember
     */
	public function testInteractWithFacebookBadInput()
	{
		//bad login
		$data = [
			'login' => '15151d'
		];
		$this->expectException(BadParameterException::class);
		$this->memberService->interactWithFacebook($data);
	}

    /**
     * @throws BadParameterException
     * @throws NotFoundException
     * @throws \App\Model\Exception\AlreadyExistException
     * @throws \App\Model\Exception\AuthenticationException
     * @throws \App\Model\Exception\BadRequestException
     * @depends testGetMember
     */
	public function testInteractWithFacebookMissingName() {
		//missing fname
		$data = [
			'lname' => 'Doe',
			'login' => '123456788', //login not exists
			'email' => 'some@example.com',
			'locale' => 'en_EN',
		];
		$this->expectException(BadParameterException::class);
		$this->memberService->interactWithFacebook($data);
	}

}
