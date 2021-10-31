<?php
/**
 * Wheater API Test PHP.
 *
 * PHP version 7.4
 *
 *
 * @author   Eduardo Esteves <eduardostevessilva@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/eduardobrau/weather-api-test-php
 */

require __DIR__ . '/vendor/autoload.php';

use App\core\Controller;
use App\components\Helpers;
use App\core\Httpd;

try{
	$controller = new Controller;
	$controller->load();
	$controller->exec();
}catch(\Exception $e){
	$code = (!empty(Httpd::getStatusCode())) ? Httpd::getStatusCode() : 500;
	Httpd::statusCode($code);
	$msg = Helpers::msgJson($e->getMessage(), $code);
	echo $msg;
	die;
}



