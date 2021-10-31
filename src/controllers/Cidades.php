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

class Cidades extends Controller {
	public function get_index($params = null) {
		echo '{"msg": "Bem vindo a Weather API", "code":200}';
		die;
	}
}