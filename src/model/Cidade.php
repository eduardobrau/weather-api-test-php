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
	 * @param JSON $document um JSON com o nome do arquivo a ser carregado.
	 * @return JSON o array de JSON sem espaços e tabs.
	 */
	public function get_all_datas($document) {
		$datas = file_get_contents($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $document);
		return Helpers::clearJson($datas);
	}

	/**
	 * Retorna a lista de cidades no formato JSON com o auxilio do metodo get_all_datas já que vai ser uma tarefa
	 * repetitiva em outros métodos.
	 *
	 * @return string o JSON sem espaços e tabs.
	 */
	public function get_index() {
		return $this->get_all_datas("city_list.json");
	}

	/**
	 * Retorna a lista de cidades que possuem um clima disponível com a informação do clima.
	 *
	 * Essa mesma função atende tres requisicoes sem parametros /cidades/climas com parametro /cidades/climas/id e
	 * tambem a listagem de cidades com clima filtrando por seu id e data por
	 * exemplo /cidades/climas/id/?data_ini=2017-03-01&data_fim=2017-03-05
	 *
	 * @return JSON sem espaços e tabs com as cidades que tem um clima.
	 */
	public function get_climas($param, $query_string) {
		if( (!is_null($param) && !is_numeric($param)) && (!is_null($query_string) && !is_string($query_string)) ){
			throw new \Exception('Internal Server Error');
		}

		$cidades       = $this->get_all_datas("city_list.json");
		$climas        = $this->get_all_datas("weather_list.json");
		$obj_climas    = json_decode($climas);
		$obj_cidades   = json_decode($cidades);

		$climas = array();

		foreach ($obj_climas as $clima) {
			foreach ($obj_cidades as $cidade) {
				if( empty($param) && ($clima->cityId === $cidade->id) ){
					$city = json_decode(json_encode($cidade), true);
					$weather = json_decode(json_encode($clima), true);
					$city = array_merge($city, array('weather' => $weather['data']));
					array_push($climas, $city);
				}else if( ($clima->cityId === (int)$param) && ($cidade->id === (int)$param) ) {
					if(isset($query_string)){
						$city 	 = array();
						$weather = array();
						parse_str($query_string, $data_choice);
						$data_ini = strtotime($data_choice['data_ini']);
						$data_fim = strtotime($data_choice['data_fim']);
						foreach($clima->data as $obj){
							if( ($data_ini <= $obj->dt) && ($obj->dt <= $data_fim) ){
								if(empty($city)){
									$city 			= json_decode(json_encode($cidade), true);
								}
								$weather[]  = json_decode(json_encode($obj), true);
							}
						}
						if(sizeof($city) >= 1){
							$city = array_merge($city, array('weather' => $weather));
							array_push($climas, $city);
						}
					}else{
						$city 				= json_decode(json_encode($cidade), true);
						$weather 			= json_decode(json_encode($clima), true);
						$city = array_merge($city, array('weather' => $weather['data']));
						array_push($climas, $city);
					}
				}
			}
		}
		if(sizeof($climas) >= 1){
			return  json_encode($climas);
		}
		return "{}";
	}
}