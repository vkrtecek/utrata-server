<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 30. 3. 2018
 * Time: 10:59
 */

namespace Tests\Feature;


use App\Model\Enum\ItemState;

class ItemTest extends AFeatureTest
{
	public function testGetWalletItemsNoMember() {
		$response = $this->get('/items/wallet/1');
		$response->assertStatus(401);
		$response->assertJson(['not found' => 'Token not found']);

	}

	public function testGetWalletItemsBadMember() {
		$response = $this->get('/items/wallet/1', ['Authorization' => $this->memberFacebookToken]);
		$response->assertStatus(401);
		$response->assertJson(['error' => 'WalletService: Member is not owner of this wallet.']);
	}

	/**
	 * @depends testGetWalletItemsNoMember
	 * @depends testGetWalletItemsBadMember
	 */
	public function testGetWalletItems() {
		$response = $this->get('/items/wallet/1', ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(2, count($response->json()));
	}

	/**
	 * @depends testGetWalletItems
	 */
	public function testGetWalletItemsWithFilters() {
		//state
		$response = $this->get('/items/wallet/1?state=' . ItemState::CHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(1, count($response->json()));

		//state
		$response = $this->get('/items/wallet/1?state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(2, count($response->json()));

		//state
		$response = $this->get('/items/wallet/1?state=' . ItemState::INCOMES, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(1, count($response->json()));

		//limit
		$response = $this->get('/items/wallet/1?limit=1&state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(1, count($response->json()));

		//year
		$response = $this->get('/items/wallet/1?year=2015&state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(2, count($response->json()));

		//year
		$response = $this->get('/items/wallet/1?year=2018&state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(204);
		$this->assertEquals('', $response->getContent());

		//month
		$response = $this->get('/items/wallet/1?month=09&state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(1, count($response->json()));

		//pattern
		$response = $this->get('/items/wallet/1?pattern=!paralen  karta&state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(1, count($response->json()));

		//notes
		$response = $this->get('/items/wallet/1?notes=5&state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(200);
		$this->assertEquals(1, count($response->json()));

		//notes - no item
		$response = $this->get('/items/wallet/1?notes=3&state=' . ItemState::UNCHECKED, ['Authorization' => $this->memberVojtaToken]);
		$response->assertStatus(204);
	}
}