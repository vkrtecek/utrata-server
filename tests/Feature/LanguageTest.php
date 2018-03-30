<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 30. 3. 2018
 * Time: 12:01
 */

namespace Tests\Feature;


class LanguageTest extends AFeatureTest
{
	public function testGetLanguages() {
		$resource = $this->get('/languages');
		$resource->assertStatus(200);
		$resource->assertJson([
			[
				'code' => 'CZK',
				'name' => 'Česky',
			],
			[
				'code' => 'ENG',
				'name' => 'English',
			],
			[
				'code' => 'SVK',
				'name' => 'Slovensky',
			],
		]);
	}
}