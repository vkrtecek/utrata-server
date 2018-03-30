<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 30. 3. 2018
 * Time: 12:07
 */

namespace Tests\Feature;


class CurrencyTest extends AFeatureTest
{
	public function testGetCurrencies() {
		$resource = $this->get('/currencies');
		$resource->assertStatus(200);
		$resource->assertJson([
			[
				'id' => 1,
				'code' => 'CZK',
				'value' => 'Kč',
				'name' => 'Česká koruna',
			],
			[
				'id' => 2,
				'code' => 'EUR',
				'value' => '€',
				'name' => 'Euro',
			],
			[
				'id' => 3,
				'code' => 'USD',
				'value' => '$',
				'name' => 'Dollar',
			],
		]);
	}
}