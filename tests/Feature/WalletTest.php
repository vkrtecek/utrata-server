<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 30. 3. 2018
 * Time: 14:39
 */

namespace Tests\Feature;


class WalletTestA extends AFeatureTest
{
	public function testGetMemberWallets() {
		$resource = $this->get('/wallets', ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(200);

		$data = $resource->json();
		$this->assertEquals(2, count($data));
		$this->assertEquals('rodičů', $data[0]['name']);
		$this->assertEquals('moje', $data[1]['name']);
	}


	public function testGetWalletBadId() {
		$resource = $this->get('/wallet/asd', ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(400);
		$resource->assertJson(['error' => 'WalletService: Not INTEGER or smaller than 1.']);
	}

	public function testGetWalletBadMember() {
		$resource = $this->get('/wallet/1', ['Authorization' => $this->memberFacebookToken]);
		$resource->assertStatus(403);
		$resource->assertJson(['error' => 'WalletService: Member is not owner of this wallet.']);
	}

	/**
	 * @depends testGetMemberWallets
	 * @depends testGetWalletBadId
	 * @depends testGetWalletBadMember
	 */
	public function testGetWallet() {
		$resource = $this->get('/wallet/1', ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(200);
	}


	public function testCreateWallet() {
		$expectedWalletId = 5;
		$dateDelayInSeconds = 3;
		$data = ['name' => 'new wallet'];
		$resource = $this->post('/wallet', $data, ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(201);
		$walletId = $resource->json();

		$this->assertEquals($expectedWalletId, $walletId);
		$resource = $this->get('/wallet/' . $walletId, ['Authorization' => $this->memberVojtaToken]);
		$this->assertEquals(2, count($resource->json()['checkState']));

		$cs1 = $resource->json()['checkState']['card']['checked'];
		$cs2 = $resource->json()['checkState']['cash']['checked'];

		$this->assertTrue((new \DateTime($cs1))->diff(new \DateTime(), TRUE)->s < $dateDelayInSeconds);
		$this->assertTrue((new \DateTime($cs2))->diff(new \DateTime(), TRUE)->s < $dateDelayInSeconds);
	}

	/**
	 * @depends testGetWallet
	 */
	public function testUpdateCheckState() {
		$dateDelayInSeconds = 3;
		$data = [
			'type' => 'karta',
			'value' => 516,
		];
		$resource = $this->put('/wallet/checkState/1', $data, ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(202);

		$cs = $resource->json();
		$this->assertEquals(516, $cs['value']);
		$this->assertTrue((new \DateTime($cs['checked']))->diff(new \DateTime(), TRUE)->s < $dateDelayInSeconds);
	}

	/**
	 * @depends testCreateWallet
	 */
	public function testUpdateWallet() {
		$walletId = 1;
		$data = ['name' => 'updated name'];
		$resource = $this->put('/wallet/' . $walletId, $data, ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(202);
		$this->assertEquals('updated name', $resource->json()['name']);
	}

	/**
	 * @depends testUpdateWallet
	 * @depends testUpdateCheckState
	 */
	public function testDeleteWallet() {
		$walletId = 1;
		$resource = $this->delete('/wallet/' . $walletId, [], ['Authorization' => $this->memberVojtaToken]);
		$this->assertEquals($walletId, $resource->getContent());
	}
}