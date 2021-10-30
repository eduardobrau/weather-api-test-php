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

use App\controllers\Cidades;

$cidades = new Cidades;
$cidades->index();



