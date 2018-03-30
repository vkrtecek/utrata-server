<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 30. 3. 2018
 * Time: 11:53
 */

namespace Tests\Feature;


class TranslationsTest extends AFeatureTest
{
	public function testGetTranslation()
	{
		$response = $this->get('/translations?language=ENG');
		$response->assertStatus(200);
		$response->assertJson([]);

		$response = $this->get('/translations?language=CZK');
		$response->assertStatus(200);
	}

	public function testBadLanguageCode()
	{
		$response = $this->get('/translations?language=DFDF');
		$response->assertStatus(404);
		$response->assertJson(['error' => 'LanguageService: No language found.']);
	}

	public function testNoLanguageCode() {
		$response = $this->get('/translations');
		$response->assertStatus(400);
		$response->assertJson(['error' => 'TranslationService: Identifier "language" not specified.']);
	}
}