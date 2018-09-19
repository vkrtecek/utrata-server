<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:31
 */

namespace Tests\Unit;


use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Enum\ItemType;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\NotFoundException;
use App\Model\Filter\ItemFilter;
use App\Model\Service\ItemService;
use Tests\Fake\Dao\FakeItemDAO;
use Tests\Fake\Service\FakeCurrencyService;
use Tests\Fake\Service\FakeItemService;
use Tests\Fake\Service\FakeMemberService;
use Tests\Fake\Service\FakePurposeService;
use Tests\Fake\Service\FakeTranslationService;
use Tests\Fake\Service\FakeWalletService;
use Tests\TestCase;

class ItemTest extends TestCase
{
	/** @var ItemService */
	private $itemService;

	/** @var ItemFilter */
	private $itemFilter;

	/** @var Member */
	private $member;
	/** @var Member */
	private $member2;

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     */
	protected function setUp() {
		parent::setUp();
		$this->itemService = new ItemService(
			new FakeItemDAO(),
			new FakeWalletService(),
			new FakeMemberService(),
			new FakePurposeService(),
			new FakeCurrencyService(),
			new FakeTranslationService()
		);
		$this->member = (new FakeMemberService())->getMember('vojta');
		$this->member2 = (new FakeMemberService())->getMember('jožka');

		$this->itemFilter = ItemFilter::create([])->setOrderHow(ItemFilter::ORDER_DESCENDANT)->setOrderBy('price');
	}

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     */
	public function testGetWalletItems() {
		$items = $this->itemService->getWalletItems(1, $this->member, $this->itemFilter);

		$this->assertEquals(3, count($items));
		foreach ($items as $item)
			$this->assertTrue($item instanceof Item);

		$this->expectException(BadRequestException::class);
		$this->itemService->getWalletItems(-1, $this->member, $this->itemFilter);
	}

    /**
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     */
	public function testGetItem() {
		$item = $this->itemService->getItem(1);
		$this->assertTrue($item instanceof Item);

		$this->expectException(NotFoundException::class);
		$this->itemService->getItem(51);
	}

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\AlreadyExistException
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\BadRequestException
     */
	public function testCreateItem() {
		$data = [
			'name' => 'item',
			'price' => 50,
			'course' => 1,
			'date' => '2018-01-01 23:59:59',
			'vyber' => TRUE,
			'member' => 'vojta',
			'currency' => [
				'code' => 'CZK'
			],
			'note' => [
				'id' => 1
			],
			'wallet' => 1,
		];
		$item = $this->itemService->createItem($this->member, $data);
		$this->assertTrue($item instanceof Item);
		$this->assertFalse($item->isOdepsat());
		$this->assertNull($item->getNote());
		$this->assertTrue($item->isIncome());
		$this->assertEquals(ItemType::CASH, $item->getType());
		$this->assertEquals('Výběr', $item->getName());


		$this->expectException(BadRequestException::class);
		$this->itemService->createItem($this->member, []);
	}

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     */
	public function testMemberCannotCheckItem() {
		$this->expectException(AuthenticationException::class);
		$this->itemService->checkItem($this->member2, 1);
	}

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     */
	public function testCheckAll() {
		$itemCnt = count($this->itemService->getWalletItems(1, $this->member, $this->itemFilter));
		$cnt = $this->itemService->checkAll(1, $this->member, $this->itemFilter);

		$this->assertEquals($itemCnt, $cnt);
	}

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\BadRequestException
     */
	public function testUpdateItem() {
		$data = [
			'name' => 'name',
			'date' => '2018-01-01 23:59:59',
			'income' => true,
			'price' => 300,
			'course' => 2.5,
		];
		$item = $this->itemService->updateItem($this->member, 1, $data);

		$this->assertEquals('name', $item->getName());
		$this->assertEquals((new \DateTime('2018-01-01 23:59:59')), $item->getDate());
		$this->assertTrue($item->isIncome());
		$this->assertEquals(300, $item->getPrice());
		$this->assertEquals(2.5, $item->getCourse());
	}

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     */
	public function testFormat() {
		$member = (new FakeMemberService())->getMember('vojta');
		$item = (new FakeItemService())->getItem(0);
		$formatted = $this->itemService->format($item, $member);
		$expected = [
			'id' => 1,
			'name' => 'some name',
			'description' => 'some desc',
			'price' => 100,
			'course' => 1,
			'date' => '2016-01-26 21:35:21',
			'active' => TRUE,
			'type' => ItemType::CARD,
			'odepsat' => FALSE,
			'vyber' => FALSE,
			'income' => FALSE,
			'note' => [],
			'currency' => [],
			'member' => 'vojta',
			'wallet' => 1,
		];

		$this->assertEquals($expected, $formatted);
	}

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws \App\Model\Exception\BadParameterException
     */
	public function testGetMonthStatistics() {
		$statistics = $this->itemService->getMonthStatistics($this->member, 1);

		$this->assertEquals(2, count($statistics));
		$this->assertArrayHasKey('full', $statistics);
		$this->assertArrayHasKey('part', $statistics);

		$expectedFull = [
			'months' => [],
			'thisMonth' => [
				'month' => (new \DateTime())->format('m'),
				'year' => (new \DateTime())->format('Y'),
				'income' => 2600.0,
				'incomesCnt' => 3,
				'expense' => 2600.0,
				'expensesCnt' => 3,
			],
			'average' => 0,
			'min' => [
				'expense' => 0,
                'month' => '00',
                'year' => '0000',
                'income' => 0,
                'incomesCnt' => 0,
                'expensesCnt' => 0,
			],
			'max' => [
				'expense' => 0,
                'month' => '00',
                'year' => '0000',
                'income' => 0,
                'incomesCnt' => 0,
                'expensesCnt' => 0,
			],
			'items' => 0,
			'totalExpense' => 0,
		];
		$this->assertEquals($expectedFull, $statistics['full']);

		$expectedPart = $expectedFull;
		$expectedPart['thisMonth'] = [
			'month' => (new \DateTime())->format('m'),
			'year' => (new \DateTime())->format('Y'),
			'income' => 0.0,
			'incomesCnt' => 0,
			'expense' => 0.0,
			'expensesCnt' => 0,
		];
		//$this->assertEquals($expectedPart, $statistics['part']);

		/*$this->assertEquals([
			'part' => $expectedPart,
			'full' => $expectedFull,
		], $statistics);*/
	}
}
