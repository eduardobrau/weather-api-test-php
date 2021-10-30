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

try{
	$controller = new Controller;
	$controller = $controller->load();
}catch(\Exception $e){
	echo $e->getMessage();
}



