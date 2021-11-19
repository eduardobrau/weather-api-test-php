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

	public function shouldReturnJsonStringWhenParametersIsValid() {
		$msgJson = Helpers::msgJson('Bad Request', 400);
		$this->assertEquals('{"msg":"Bad Request","code":400}', $msgJson);
	}

	/**
	 * @dataProvider msgToJsonShouldThrowExceptionDataProvider
	*/
	public function testMsgToJsonShouldThrowException($message, $code) {
		$this->expectException('\Exception');
		Helpers::msgJson($message, $code);
	}

	public function msgToJsonShouldThrowExceptionDataProvider() {
		return [
			'shouldThowExceptionWhenMessageIsNotAstring' 	=> ['message' => 1212121, 'code' => 404],
			'shouldThowExceptionWhenCodeIsNotAnumber' 		=> ['message' => 'Bad Request', 'code' => '404']
		];
	}

	/**
	 * @dataProvider removeLastBarShouldThrowExceptionDataProvider
	*/
	public function testRemoveLastBarShouldThrowException($uri) {
		$this->expectException('\Exception');
		Helpers::removeLastBar($uri);
	}

	public function removeLastBarShouldThrowExceptionDataProvider() {
		return [
			'shouldThrowExceptionWhenUriIsEmpty' 		 => ['uri' => ''],
			'shouldThrowExceptionWhenUriIsNotString' => ['uri' => 123123]
		];
	}

	/**
	 * @dataProvider removeLastBarDataProvider
	*/
	public function testRemoveLastBar($uri, $expected){
		$result = Helpers::removeLastBar($uri);
		$this->assertEquals($expected, $result);
	}

	public function removeLastBarDataProvider() {
		return [
			'shouldRemoveLastBarWhenExist' 		=> ['uri' => 'http://localhost:8000/cidades/', 'expected' => 'http://localhost:8000/cidades'],
			'shouldNotRemoveWhenHasNotExist' 	=> ['uri' => 'http://localhost:8000/cidades', 'expected' => 'http://localhost:8000/cidades']
		];
	}

	/**
	 * @dataProvider clearJsonDataProvider
	*/
	public function testClearJson($json, $expected) {
		$result = Helpers::clearJson($json);
		$this->assertEquals($expected, $result);
	}

	public function clearJsonDataProvider() {
		return [
			'shouldClearJsonWhenCotainManySpaces'				  => [
				'json' => '{"test": "Hello   World!  "}',
				'expected' => '{"test": "Hello World!"}'
			],
			'shouldReturnSameJsonWhenNotCotainManySpaces' => [
				'json' => '{"test": "Hello World!"}',
				'expected' => '{"test": "Hello World!"}'
			]
		];
	}

	/**
	 * @dataProvider jsonToObjectDataProvider
	*/
	public function testJsonToObject($json, $expected) {
		$result = Helpers::jsonToObject($json);
		$this->assertEquals($expected, $result);
	}

	public function jsonToObjectDataProvider() {
		return [
			'shouldReturnTrueBooleanWhenBeJson' 					=> [
				'json' => '{"test": "Hello World!"}',
				'expected' => true
			],
			'shouldReturnTrueBooleanWhenBeArrayOfJson' 		=> [
				'json' => '[{"test": "Hello World!"},{"test2": "Hello World2!"}]',
				'expected' => true
			],
			'shouldReturnFalseBooleanWhenNotBeJson' 			=> [
				'json' => 'Hello World!',
				'expected' => false
			]
		];
	}

}