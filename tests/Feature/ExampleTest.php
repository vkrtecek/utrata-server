<?php

namespace Tests\Feature;

use App\Model\Entity\Translation;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExampleTest extends TestCase
{

	protected function setUp() {
		parent::setUp();
		Artisan::call('migrate:refresh', ['--seed' => '']);
		//Artisan::call('migrate', ['--database' => 'sqlite']);
		Artisan::call('db:seed', ['--database' => 'sqlite']);
	}

	/**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest() {
        $response = $this->get('/');
        $response->assertStatus(404);
    }

    public function testTranslation() {
		$response = $this->get('/translations?language=ENG');
		$response->assertStatus(200);
	}
}
