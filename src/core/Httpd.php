<?php

/**
 * Wheater API Test PHP.
 *
 * PHP version 7.4
 *
 *
 * @description  	Classe responsável por tratativas de requisições http.
 * @author   			Eduardo Esteves <eduardostevessilva@gmail.com>
 * @date					31/10/2021 15:30
 * @link     			https://github.com/eduardobrau/weather-api-test-php
 */

namespace App\core;


class Httpd{

	private static $method;
	private static $status_code;

	public static function statusCode($status, $header='Content-Type: application/json;charset=utf-8'){
		header($header);
		http_response_code($status);
	}

	public static function getMethodHttp(){
		self::$method = strtolower($_SERVER['REQUEST_METHOD']);
		return self::$method;
	}

	public static function setStatusCode($code) {
		self::$status_code = $code;
	}

	public static function getStatusCode() {
		return self::$status_code;
	}
}
