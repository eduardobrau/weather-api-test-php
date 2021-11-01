<?php

/**
 * Wheater API Test PHP.
 *
 * PHP version 7.4
 *
 * @description  	Classe que representa o recurso /cidades e carregar seus metodos conforme a requisição recebida.
 * @author   			Eduardo Esteves <eduardostevessilva@gmail.com>
 * @date					31/10/2021 15:30
 * @link     			https://github.com/eduardobrau/weather-api-test-php
 */

namespace App\controllers;


use App\core\Controller;
use App\model\Cidade;
use App\components\Helpers;
use App\core\Httpd;
use PHPUnit\Util\Json;

class Cidades extends Controller {
	/**
	 * Retorna a lista de cidades no formato JSON já devolvendo o status code apropriado para a requisição.
	 *
	 * @return array um array de Json sem espaços e tabs.
	 */
	public function get_index($params = null) {
		$cidade = new Cidade;
		$datas = $cidade->get_index();
		if( (empty($datas)) || (!Helpers::jsonToObject($datas)) ){
			throw new \Exception('Internal Server Error');
		}
		Httpd::statusCode(200);
		echo $datas;
		die;
	}
}