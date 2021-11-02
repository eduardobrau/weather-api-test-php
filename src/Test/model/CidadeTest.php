<?php

namespace App\Test\model;

use App\model\Cidade;
use PHPUnit\Framework\TestCase;


class CidadeTest extends TestCase {
	public function teste() {
		$_SERVER['DOCUMENT_ROOT'] = "C:\\Users\\eduar\\Documents\\weather-api-test-php";
		$cidade = new Cidade();
		$json = $cidade->get_all_datas('doc_teste.json');
		$this->assertEquals('{"teste": "teste"}', $json);
	}

}