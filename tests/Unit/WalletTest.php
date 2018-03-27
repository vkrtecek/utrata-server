<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 3. 2018
 * Time: 23:52
 */

namespace Tests\Unit;


use App\Model\Entity\Member;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Service\WalletService;
use \DateTime;
use Tests\Exception\FirstDeleteForeignException;
use Tests\Fake\Dao\FakeWalletDAO;
use Tests\Fake\Service\FakeCheckStateService;
use Tests\Fake\Service\FakeMemberService;
use Tests\TestCase;

class WalletTest extends TestCase
{
	/** @var WalletService */
	protected $walletService;

	/** @var Member */
	protected $member;

	/** @var Member */
	protected $member2;

	protected function setUp() {
		parent::setUp();
		$this->walletService = new WalletService(
			new FakeWalletDAO(),
			new FakeMemberService(),
			new FakeCheckStateService()

		);
		$this->member = (new FakeMemberService)->getMember('vojta');
		$this->member2 = (new FakeMemberService)->getMember('jožka');
	}

	public function testGetWallet() {
		$wallet = $this->walletService->getWallet(1, $this->member);

		$this->assertEquals($this->member, $wallet->getMember());

		$this->expectException(AuthenticationException::class);
		$this->walletService->getWallet(1, $this->member2);

		$this->expectException(BadParameterException::class);
		$this->walletService->getWallet('asda', $this->member);
	}

	public function testCreateWallet() {
		$dateDelayInSeconds = 2;
		$walletName = 'some name';
		$wallet = $this->walletService->createWallet($this->member, $walletName);

		$this->assertEquals($walletName, $wallet->getName());
		$this->assertEquals($this->member, $wallet->getMember());
		$this->assertTrue($wallet->getCreated()->diff(new DateTime())->s < $dateDelayInSeconds);
	}

	public function testUpdateWallet() {
		$dateDelayInSeconds = 2;
		$newWalletName = 'some name';
		$wallet = $this->walletService->updateWallet($this->member, 1, $newWalletName);

		$this->assertEquals($newWalletName, $wallet->getName());
		$this->assertEquals($this->member, $wallet->getMember());
		$this->assertTrue($wallet->getModified()->diff(new DateTime())->s < $dateDelayInSeconds);

		$this->expectException(AuthenticationException::class);
		$this->walletService->updateWallet($this->member2, 1, $newWalletName);
	}

	public function testFormat() {
		$wallet = $this->walletService->getWallet(1, $this->member);
		$formatted = $this->walletService->format($wallet);
		$expected = [
			'id' => 1,
			'name' => 'wallet name 1',
			'itemsCnt' => 0,
			'activeItemsCnt' => 0,
			'nonActiveItemsCnt' => 0,
			'incomeItemsCnt' => 0,
			'cardRest' => 0,
			'cashRest' => 0,
			'checkState' => [
				'card' => [],
				'cash' => [],
			],
			'monthExpense' => 0,
			'empty' => TRUE,
		];

		$this->assertEquals($expected, $formatted);
	}

	public function testDeleteWallet() {
		$this->expectException(FirstDeleteForeignException::class);
		$this->walletService->deleteWallet(1, $this->member);
	}
}