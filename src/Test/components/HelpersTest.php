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

	public function testshouldReturnJsonStringWhenParametersIsValid() {
		$msgJson = Helpers::msgJson('Bad Request', 400);
		$this->assertEquals('{"msg":"Bad Request","code":400}', $msgJson);
	}

	/**
	 * @dataProvider dataProviderMsgToJsonShouldThowException
	*/
	public function testMsgToJsonShouldThowException($message, $code) {
		$this->expectException('\Exception');
		Helpers::msgJson($message, $code);
	}

	public function dataProviderMsgToJsonShouldThowException() {
		return [
			'shouldThowExceptionWhenMessageIsNotAstring' 	=> ['message' => 1212121, 'code' => 404],
			'shouldThowExceptionWhenCodeIsNotAnumber' 		=> ['message' => 'Bad Request', 'code' => '404']
		];
	}

}