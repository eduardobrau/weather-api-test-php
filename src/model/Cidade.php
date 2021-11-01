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

namespace App\model;

use App\components\Helpers;

class Cidade {

	/**
	 * Retorna a lista de cidades no formato JSON.
	 *
	 * @return string o JSON sem espaços e tabs.
	 */
	public function get_all_datas() {
		$datas = file_get_contents($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "city_list.json");
		return Helpers::clearJson($datas);
	}

	/**
	 * Retorna a lista de cidades no formato JSON com o auxilio do metodo get_all_datas já que vai ser uma tarefa
	 * repetitiva em outros métodos.
	 *
	 * @return string o JSON sem espaços e tabs.
	 */
	public function get_index() {
		return $this->get_all_datas();
	}
}