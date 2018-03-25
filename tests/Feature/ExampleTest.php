<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExampleTest extends TestCase
{
	/*
	//DATABASE 'utrata_test' REQUIRED
	public function createApplication() {
		$app = require __DIR__ . '/../../bootstrap/app.php';
		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
		return $app;
	}

	public function setUp() {
		parent::setUp();
		Artisan::call('migrate');
		Artisan::call('db:seed');
	}*/

	/**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
    	/*
        $response = $this->get('/');
        $response->assertStatus(404);
    	*/
    }

    public function testTranslation() {
		//$response = $this->get('/translations?language=ENG');
		//$response->assertStatus(200);
	}
}
