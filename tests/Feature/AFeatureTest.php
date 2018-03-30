<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

abstract class AFeatureTest extends TestCase
{
	protected $memberVojtaToken = 'some token';
	protected $memberFacebookToken = 'some token 2';

	protected function setUp() {
		parent::setUp();
		Artisan::call('migrate:refresh', ['--seed' => '']);
		Artisan::call('db:seed', ['--database' => 'sqlite']);
	}
}
