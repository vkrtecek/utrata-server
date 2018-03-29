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
	}*/

	protected function setUp() {
		parent::setUp();
	}

	/**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest() {
    	/*
        $response = $this->get('/');
        $response->assertStatus(404);
    	*/
    	dump(\App\Model\Entity\Language::where('LanguageCode', 'CZK')->get());
    }

    //public function testTranslation() {
	//	echo 'second test';
		//$response = $this->get('/translations?language=ENG');
		//$response->assertStatus(200);
	//}
}
