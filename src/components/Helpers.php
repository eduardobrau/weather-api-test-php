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

namespace App\components;


class Helpers{

	/**
	 * Formata as respostas generica da API quando algo não sair como esperado, exemplo, erro.
	 *
	 * @param string $message a mensagem a ser apresentada na resposta.
	 * @param int $code status code http.
	 * @return json a mensagem da API no formato json.
	 */
	public static function msgJson($message, $code) {
		if(!is_string($message) || !is_int($code)){
			throw new \Exception('Parametros informado estão incorreto');
		}
		$msg = [
			'msg' 	=> $message,
			'code' 	=> $code
		];
		return \json_encode($msg);
	}

	/**
	 * Valida se a uri tem uma barra "/" em caso positivo remove-a.
	 *
	 * @param string $uri a uri digitada na url.
	 * @return string a uri sem conter uma barra no final.
	 */
	public static function removeLastBar($uri) {
		if(empty($uri) || !is_string($uri)){
			$msg = self::msgJson('Erro ao processar a uri', 500);
			throw new \Exception($msg);
		}
		$bar = substr($uri, -1);
		if($bar === "/"){
			$uri = substr($uri, 0, -1);
		}
		return $uri;
	}

	/**
	 * Limpa espaços e tabs de um JSON reduzindo o tamanho dos dados trafegado na rede.
	 *
	 * @param string $json uma string JSON.
	 * @return array o array de json sem espaços e tabs.
	 */
	public static function clearJson($json){
		return preg_replace('/(\r\n||\t||\s{2})/', '', $json);
	}

	/**
	 * Avalia se o JSON informado pode ser convertido em um objeto tipo std class.
	 *
	 * @param json uma string JSON.
	 * @return boolean true ou falso para a avaliação.
	 */
	public static function jsonToObject($json){
		$datas = json_decode($json);
		return (is_array($datas) && sizeof($datas) >= 1) ? is_object($datas[0]) : is_object($datas);
	}

}