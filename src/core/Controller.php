<?php

/**
 * Wheater API Test PHP.
 *
 * PHP version 7.4
 *
 * @description  	Classe responsável por instaciar os controllers do App e seus parâmetros de forma dinâmica.
 * @author   			Eduardo Esteves <eduardostevessilva@gmail.com>
 * @date					31/10/2021 15:30
 * @link     			https://github.com/eduardobrau/weather-api-test-php
 */

namespace App\core;

use App\core\Uri;
use App\components\Helpers;
use App\core\Httpd;

class Controller {

	private static $uri;
	private $name_space;
	private $action;
	private $params;
	const DIR_CONTROLLER = "\\App\\controllers\\";

	/**
	 * Retorna uma instância da classe Uri do core do micro framework com a idéia de composição.
	 *
	 * @return object
	 */
	public static function Uri() {
		return self::$uri = Uri::getInstance();
	}

	/**
	 * Tenta fazer o carregamento do controller se tudo ocorrer bem conforme a url recebida.
	 *
	 * Caso o controller existir seta a action e seus params a serem executados pelo controller.
	 * @return void seta a action e seus parametros caso informado na url.
	 */
	public function load() {
		$this->name_space = self::DIR_CONTROLLER . Controller::Uri()::getController();
		if (class_exists($this->name_space)) {
			$this->setAction();
			$this->setParams();
		}else {
			Httpd::setStatusCode(404);
			throw new \Exception('Not Found');
		}
	}

	/**
	 * Captura a action da url caso informado, para ser executada posterior pelo seu controller correspondente.
	 *
	 * @return void apenas seta a propriedade action de sua classe para ser executado posterior.
	 */
	protected function setAction() {
		$this->action = Controller::Uri()::getAction();
	}

	/**
	 * Captura os parâmetros da url caso informado.
	 *
	 * @return void apenas seta a propriedade params na classe para uso posterior.
	 */
	protected function setParams() {
		$this->params = Controller::Uri()::getParams();
	}

	public function exec() {
		$controller = new $this->name_space();
		$method_http = Httpd::getMethodHttp();
		$action = $controller::Uri()::getAction();
		$action = "{$method_http}_{$action}";
		$params = $controller::Uri()::getParams();

		if(!method_exists($controller, $action)){
			Httpd::statusCode(404);
			throw new \Exception('Not found');
		}
		$controller->$action($params);
	}

}