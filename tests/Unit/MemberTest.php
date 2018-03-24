<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:32
 */

namespace Tests\Unit;


use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\MemberService;
use Tests\Fake\Dao\FakeMemberDAO;
use Tests\Fake\Service\FakeCurrencyService;
use Tests\Fake\Service\FakeLanguageService;
use Tests\Fake\Service\FakeMemberPurposeService;
use Tests\Fake\Service\FakePurposeService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MemberTest extends TestCase
{
	/** @var MemberService */
	private $memberService;

	protected function setUp() {
		parent::setUp();
		$this->memberService = new MemberService(
			(new FakeMemberDAO()),
			(new FakeLanguageService()),
			(new FakeCurrencyService()),
			(new FakePurposeService()),
			(new FakeMemberPurposeService())
		);
	}


	/**
	 * A basic test example.
	 *
	 * @return void
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
			'email' => 'some@example.com',
			'locale' => 'en_EN',
		];
		$member = $this->memberService->interactWithFacebook($data);
		$this->assertEquals('John', $member->getFirstName());
		$this->assertEquals('Doe', $member->getLastName());
		$this->assertEquals('123456788', $member->getLogin());
		$this->assertEquals(MemberService::defaultEmail, $member->getMyMail());
		$this->assertEquals(MemberService::defaultEmail, $member->getMotherMail());
		$this->assertEquals('EUR', $member->getCurrency()->getCode());
		$this->assertEquals('ENG', $member->getLanguage()->getCode());
		$this->assertTrue($member->isFacebook());
	}

	public function testInteractWithFacebookBadInput() {
		//bad login
		$data = [
			'login' => '15151d'
		];
		$this->expectException(BadParameterException::class);
		$this->memberService->interactWithFacebook($data);

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