<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 0:16
 */

namespace Tests\Unit;


use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Exception\AlreadyExistException;
use App\Model\Service\PurposeService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tests\Fake\Dao\FakePurposeDAO;
use Tests\Fake\Service\FakeLanguageService;
use Tests\Fake\Service\FakeMemberPurposeService;
use Tests\Fake\Service\FakeMemberService;
use Tests\TestCase;

class PurposeTest extends TestCase
{
	/** @var PurposeService */
	protected $purposeService;

	/** @var Member */
	protected $member;
	/** @var Member */
	protected $member2;

	private $languageCode = 'CZK'; //set in FakePurposeDAO

    /**
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	protected function setUp() {
		parent::setUp();
		$this->purposeService = new PurposeService(
			new FakePurposeDAO(),
			new FakeLanguageService(),
			new FakeMemberPurposeService()
		);
		$this->member = (new FakeMemberService())->getMember('vojta');
		$this->member2 = (new FakeMemberService())->getMember('jožka');
	}

    /**
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function testGetLanguagePurposes() {
		$purposes = $this->purposeService->getLanguagePurposes($this->languageCode);

		$this->assertEquals(2, count($purposes));
		/** @var Purpose $purpose */
        foreach ($purposes as $purpose)
			$this->assertEquals($this->languageCode, $purpose->getLanguage()->getCode());
	}

    /**
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function testGetLanguageBasePurposes() {
		$purposes = $this->purposeService->getLanguageBasePurposes($this->languageCode);

		$this->assertEquals(1, count($purposes));
		/** @var Purpose $purpose */
        foreach ($purposes as $purpose)
			$this->assertTrue($purpose->isBase());
	}

    /**
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function testGetUserLanguagePurposes() {
		$purposes = $this->purposeService->getUserLanguagePurposes($this->member, $this->languageCode);

		$this->assertEquals(2, count($purposes));
		/** @var Purpose $purpose */
        foreach ($purposes as $purpose)
			$this->assertTrue($purpose->isBase() || $purpose->getCreator() == $this->member);

		$purposes = $this->purposeService->getUserLanguagePurposes($this->member2, $this->languageCode);

		$this->assertEquals(1, count($purposes));
		foreach ($purposes as $purpose)
			$this->assertTrue($purpose->isBase() || $purpose->getCreator() == $this->member2);
	}

    /**
     * @throws \App\Model\Exception\NotFoundException
     */
	public function testGetUserPurposes() {
		$purposes = $this->purposeService->getUserPurposes($this->member);

		$this->assertEquals(1, count($purposes));
		/** @var Purpose $purpose */
        foreach ($purposes as $purpose)
			$this->assertTrue($purpose->isBase() || $purpose->getCreator() == $this->member);
	}

    /**
     * @throws AlreadyExistException
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function testCreatePurpose() {
		$data = [
			'name' => 'Lížátko',
			'language' => 'ENG',
		];
		$purpose = $this->purposeService->createPurpose($this->member, $data);

		$this->assertEquals('ENG', $purpose->getLanguage()->getCode());
		$this->assertEquals('lizatko', $purpose->getCode());
		$this->assertEquals('Lížátko', $purpose->getValue());

		$this->expectException(AlreadyExistException::class);
		$this->purposeService->createPurpose($this->member, [
			'name' => 'Jídlo'
		]);

		$this->expectException(BadRequestHttpException::class);
		$this->purposeService->createPurpose($this->member, []);
	}

    /**
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function testFormat() {
		$member = (new FakeMemberService())->getMember('vojta');
		$purpose = $this->purposeService->getPurpose(1); // 1 for transport with id=2
		$this->assertTrue($purpose instanceof Purpose);

		$formatted = $this->purposeService->format($purpose, $member);
		$expected = [
			'id' => 2,
			'code' => 'transport',
			'value' => 'Transport',
			'deletable' => TRUE,
			'unselectable' => TRUE,
		];

		$this->assertEquals($expected, $formatted);
	}

}
