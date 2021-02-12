<?php
require('./Services/PokeService.php');
require('./Services/OpenWeatherService.php');
require('./helpers.php');


$pokeApi = new PokeService();
$weatherApi = new OpenWeatherService();

$weatherResult = [];
$pokeInfo = [];
$type = [
    'theme' => 'cosmo'
];

if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $weatherResult = $weatherApi->getWeatherByCity($city);
    $type = getPokemonType($weatherResult);
    $pokemonList = $pokeApi->getPokemonsByType($type['type']);
    $randomPokemon = $pokemonList[rand(0, count($pokemonList) - 1)]['pokemon'];
    $pokeInfo = $pokeApi->getPokemonByName($randomPokemon['name']);

}
$cssUrl = "https://bootswatch.com/4/" . $type['theme'] . "/bootstrap.min.css";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokéfodase</title>
    <link rel="stylesheet" href="<?= $cssUrl ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="https://twitter.com/danielhe4rt">Twitter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/danielhe4rt">Github</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <hr>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <img src="<?= $pokeInfo['sprites']['front_default'] ?? './assets/images/placeholder.png' ?>"
                     class="card-img-top" alt="...">
                <?= $pokeInfo['name'] ? "<div class='alert alert-primary text-center' style='color: white; font-size: 16px;'>" . ucfirst($pokeInfo['name']) . "</div>" : "" ?>
                <?= $weatherResult['weather'] ? "<div class='text-center'> <span class='badge badge-primary'>" . implode(', ', $weatherResult['weather']) . "</span></div>" : "" ?>
                <?= $weatherResult['raining'] ? "<div class='text-center'> <span class='badge badge-primary'> TÁ CHOVENDO PRA KRL</span></div>" : "" ?>
                <div class="card-body">
                    <h5 class="card-title text-center">Pokéfodase Weather Map</h5>
                    <form>
                        <fieldset>
                            <div class="form-group ">
                                <label for="city" class="col-sm-12 col-form-label text-center">Selecione uma
                                    cidade</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control text-center" id="city" name="city"
                                           value="Magé">
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary ">Pesquisar</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>