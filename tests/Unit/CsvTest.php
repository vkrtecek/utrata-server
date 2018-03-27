<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 23:57
 */

namespace Tests\Unit;


use App\Model\Entity\File;
use App\Model\Entity\Member;
use App\Model\Service\CsvService;
use Tests\Fake\Dao\FakeCheckStateDAO;
use Tests\Fake\Dao\FakeItemDAO;
use Tests\Fake\Dao\FakeMemberDAO;
use Tests\Fake\Dao\FakePurposeDAO;
use Tests\Fake\Dao\FakeWalletDAO;
use Tests\Fake\Service\FakeCheckStateService;
use Tests\Fake\Service\FakeCurrencyService;
use Tests\Fake\Service\FakeItemService;
use Tests\Fake\Service\FakeLanguageService;
use Tests\Fake\Service\FakeMemberService;
use Tests\Fake\Service\FakePurposeService;
use Tests\Fake\Service\FakeWalletService;
use Tests\TestCase;

class CsvTest extends TestCase
{
	/** @var CsvService */
	private $csvService;

	/** @var Member */
	private $member;

	/** @var File */
	private $file;

	protected function setUp() {
		parent::setUp();
		$this->csvService = new CsvService(
			new FakeMemberDAO(),
			new FakePurposeDAO(),
			new FakeWalletDAO(),
			new FakeItemDAO(),
			new FakeCheckStateDAO(),
			new FakeWalletService(),
			new FakeCheckStateService(),
			new FakePurposeService(),
			new FakeLanguageService(),
			new FakeCurrencyService(),
			new FakeMemberService(),
			new FakeItemService()
		);
		$this->member = (new FakeMemberService())->getMember('vojta');
		$this->setUpFile();
	}

	protected function setUpFile(array $lines = NULL) {
		$expected = new File();
		$expected->appendLine('Štěpán;Krteček;vojta;;;;;;2017-08-26 22:23:38;CZK;1');
		$expected->appendLine('1');
		$expected->appendLine(';transport;Transport;;CZK;vojta');
		$expected->appendLine('2');
		$expected->appendLine('1;wallet name 1');
		$expected->appendLine('2;wallet name 2');
		$expected->appendLine('3');
		$expected->appendLine('1;some name;some desc;100;1;2016-01-26 21:35:21;2018-03-26 21:35:21;karta;1;0;0;0;;CZK;1');
		$expected->appendLine('2;another name;another desc;500;2.5;2016-01-26 21:35:21;2018-03-26 21:35:21;hotovost;1;1;0;0;;CZK;1');
		$expected->appendLine('3;another name;another desc;500;2.5;2016-01-26 21:35:21;2018-03-26 21:35:21;hotovost;1;0;1;0;;CZK;1');
		$expected->appendLine('4');
		$expected->appendLine('1;1;karta;2018-03-26 22:23:38;100');
		$expected->appendLine('2;1;hotovost;2018-03-26 22:23:38;30');
		$expected->appendLine('1;1;karta;2018-03-26 22:23:38;100');
		$expected->appendLine('2;1;hotovost;2018-03-26 22:23:38;30');
		$this->file = $expected;
	}

	public function testGetBackup() {
		$content = $this->csvService->getBackup($this->member);

		$this->assertEquals($this->file->getContent(), $content);
	}

	/**
	 * @depends testGetBackup
	 */
	public function testStoreBackup() {
		$this->setUpFile([]);
		$this->csvService->storeBackup($this->member, $this->file->getContent());
	}
}