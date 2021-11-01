<?php

/**
 * Wheater API Test PHP.
 *
 * PHP version 7.4
 *
 * @description  	Classe responsável por capturar valores da url e distinguir o que é controller, actions, params etc..
 * @author   			Eduardo Esteves <eduardostevessilva@gmail.com>
 * @date					31/10/2021 15:30
 * @link     			https://github.com/eduardobrau/weather-api-test-php
 */

namespace App\core;


use App\components\Helpers;
use App\core\Httpd;


class Uri {
	// Retorna a instância da própria classe, caso já exista, retorna a instância existente (Singleton).
	private static $instance;
	public static $controller;
	public static $action;
	public static $param;
	public static $query_string;

	/**
	 * @return string ignorando query string
	 */
	public static function getUri() {
		return parse_url(substr($_SERVER['REQUEST_URI'],1), PHP_URL_PATH);
	}

	/**
	 * Garante que só seja carregada apenas uma instância da classe.
	 *
	 * @return self uma instância da própria classe a ser usada por outras classes.
	 */
	public static function getInstance() {
		if( empty(self::$instance) ){
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Retorna o controller levando em consideração que na url: http://localhost:8000/cidades/10
	 *
	 * o primeiro valor da uri será sempre o controller seguindo a convenção da orientação a objetos
	 * http://localhost:8000/controller/action/param
	 * @return string que representa o controller a ser carregado caso exista.
	 */
	public static function getController() {
		$controller = explode('/', self::getUri());
		$controller = ucfirst($controller[0]);
		self::$controller = $controller;
		return $controller;
	}

	public static function getAction() {
		$uri 				= self::getUri();
		$uri 				= Helpers::removeLastBar($uri);
		$action 		= explode('/', $uri);
		$action = (isset($action[1])) ? strtolower($action[1]) : "/";

		if(!is_string($action)){
			Httpd::statusCode(400);
			$msg = Helpers::msgJson('Bad Request', 400);
			echo $msg;
			die;
		}else if( empty($action) || $action === "/" || is_numeric($action) ){
			$action = 'index';
		}

		self::$action = $action;
		return $action;
	}

	public static function getParams() {
		$uri 			 = self::getUri();
		$uri 			 = Helpers::removeLastBar($uri);
		$uriArray  = explode('/', $uri);

		if(!in_array(self::$action, $uriArray)){
			array_splice($uriArray, 1, 0, self::$action);
		}
		$params = array();
		foreach($uriArray as $key => $uri) {
			if($key>1) {
				$params[] = $uri;
			}
		}
		if(sizeof($params) > 1) {
			Httpd::setStatusCode(400);
			throw new \Exception('Bad Request');
		}else if(sizeof($params) == 1){
			$param = $params[0];
		}else{
			$param = null;
		}
		self::$param = $param;
		return self::$param;
	}

	public static function getQueryString() {
		$query_string = (!empty($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : null;
		self::$query_string = $query_string;
		return $query_string;
	}

}