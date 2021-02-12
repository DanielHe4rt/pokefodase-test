<?php

require('./Services/PokeService.php');
require('./Services/OpenWeatherService.php');

$pokeApi = new PokeService();
$weatherApi = new OpenWeatherService();

$result = $weatherApi->getWeatherByCity('Santos');
var_dump($result);
