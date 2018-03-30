<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 30. 3. 2018
 * Time: 12:18
 */

namespace Tests\Feature;


class PurposeTest extends AFeatureTest
{
	public function testGetUserPurposesMemberNotLogged() {
		$resource = $this->get('/purposes');
		$resource->assertStatus(401);
		$resource->assertJson(['auth' => 'Member not logged.']);
	}

	/**
	 * @depends testGetUserPurposesMemberNotLogged
	 */
	public function testGetUserPurposes() {
		$resource = $this->get('/purposes', ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(200);
		$resource->assertJson(['purposes' => [
			[
				'id' => 1,
				'code' => 'jidlo',
				'value' => 'Jídlo',
			],
			[
				'id' => 2,
				'code' => 'transport',
				'value' => 'Transport',
			],
			[
				'id' => 5,
				'code' => 'ostatni',
				'value' => 'Ostatní',
			],
		]]);
	}

	/**
	 * @depends testGetUserPurposes
	 */
	public function testGetUserPurposesAnotherMember() {
		$resource = $this->get('/purposes', ['Authorization' => $this->memberFacebookToken]);
		$resource->assertStatus(200);
		$resource->assertJson(['purposes' => [
			[
				'id' => 6,
				'code' => 'food',
				'value' => 'Food',
			],
			[
				'id' => 7,
				'code' => 'other',
				'value' => 'Other',
			],
		]]);
	}

	public function testGetLanguagePurposesBadLanguageCode() {
		$resource = $this->get('/purposes/language/asdad', ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(404);
		$resource->assertJson(['error' => 'LanguageService: No language found.']);
	}

	/**
	 * @depends testGetLanguagePurposesBadLanguageCode
	 */
	public function testGetLanguagePurposes() {
		$resource = $this->get('/purposes/language/CZK', ['authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(200);
		$resource->assertJson(['purposes' => [
			[
				'id' => 1,
				'code' => 'jidlo',
				'value' => 'Jídlo',
			],
			[
				'id' => 2,
				'code' => 'transport',
				'value' => 'Transport',
			],
			[
				'id' => 5,
				'code' => 'ostatni',
				'value' => 'Ostatní',
			],
		]]);
	}

	/**
	 * @depends testGetLanguagePurposes
	 */
	public function testGetLanguagePurposesNoPurpose() {
		$resource = $this->get('/purposes/language/SVK', ['authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(404);
		$resource->assertJson(['error' => 'PurposeService: No purpose found.']);
	}

	public function testCreatePurpose() {
		$body = [
			'note' => [
				'name' => 'Svíčková',
				'language' => NULL, //users's own language
			]
		];
		$resource = $this->post('/purpose', $body, ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(201);
		$resource->assertJson([
			'id' => 8,
			'code' => 'svickova',
			'value' => 'Svíčková',
		]);
	}

	public function testCreatePurposeInOtherLanguage() {
		$body = [
			'note' => [
				'name' => 'Svíčková',
				'language' => 'ENG',
			]
		];
		$resource = $this->post('/purpose', $body, ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(201);
		$resource->assertJson([
			'id' => 8,
			'code' => 'svickova',
			'value' => 'Svíčková',
		]);

		//Member has new purpose
		$resource = $this->get('/purposes', ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(200);
		$resource->assertJson(['purposes' => [
			[
				'id' => 1,
				'code' => 'jidlo',
				'value' => 'Jídlo',
			],
			[
				'id' => 2,
				'code' => 'transport',
				'value' => 'Transport',
			],
			[
				'id' => 5,
				'code' => 'ostatni',
				'value' => 'Ostatní',
			],
			[
				'id' => 8,
				'code' => 'svickova',
				'value' => 'Svíčková',
			],
		]]);
	}

	/**
	 * @depends testCreatePurposeInOtherLanguage
	 * @depends testCreatePurpose
	 */
	public function testCreatePurposeWithExistingCode() {
		$body = [
			'note' => [
				'name' => 'jiDLó',
				'language' => NULL, //users's own language
			]
		];
		$resource = $this->post('/purpose', $body, ['Authorization' => $this->memberVojtaToken]);
		$resource->assertStatus(409);
		$resource->assertJson(['error' => 'Note with this code already exists']);
	}
}