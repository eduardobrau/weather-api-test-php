<?php

/**
 * Wheater API Test PHP.
 *
 * PHP version 7.4
 *
 *
 * @description  	Classe responsável por fazer algumas validações e outras funções repetitivas.
 * @author   			Eduardo Esteves <eduardostevessilva@gmail.com>
 * @date					31/10/2021 15:30
 * @link     			https://github.com/eduardobrau/weather-api-test-php
 */

namespace App\Test\components;

use App\components\Helpers;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase {
	public function testConverterMsgJson() {
		$msgJson = Helpers::msgJson('Bad Request', 400);
		$this->assertEquals('{"msg":"Bad Request","code":400}', $msgJson);
	}

	public function testMessageIsNotString() {
		$this->expectException('\Exception');
		Helpers::msgJson(2121212, 400);
	}

	public function testCodeIsNotInterger() {
		$this->expectException('\Exception');
		Helpers::msgJson('Bad Request', '400');
	}
}