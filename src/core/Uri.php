<?php

namespace App\core;


class Uri {
	// Retorna a instância da própria classe, caso já exista, retorna a instância existente (Singleton).
	private static $instance;
	public static $controller;
	public static $action;
	public static $params;

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
		$uri = self::getUri();

		if(empty($uri) || !is_string($uri)){
			$msg = self::msgJson('Bad Request', 400);
			throw new \Exception($msg);
		}

		$bar = substr($uri, -1);

		if($bar === "/"){
			$uri = substr($uri, 0, -1);
		}

		$action = explode('/', $uri);
		$action = strtolower($action[1]);

		if(!is_string($action)){
			$erro = [
				'msg' 	=> 'Bad Request',
				'code' 	=> 400
			];
			$erro = \json_encode($erro);
			throw new \Exception($erro);
		}else if( empty($action) || $action === "/" || is_numeric($action) ){
			$action = 'index';
		}

		self::$action = $action;
		return $action;
	}

	public static function getParams() {
		$uri = self::getUri();

		if(empty($uri) || !is_string($uri)){
			$msg = self::msgJson('Bad Request', 400);
			throw new \Exception($msg);
		}

		$bar = substr($uri, -1);

		if($bar === "/"){
			$uri = substr($uri, 0, -1);
		}

		$uriArray = explode('/', $uri);

		if(!in_array(self::$action, $uriArray)){
			array_splice($uriArray, 1, 0, self::$action);
		}
		foreach($uriArray as $key => $uri) {
			if($key>1) {
				self::$params[] = $uri;
			}
		}
		return self::$params;
	}

}