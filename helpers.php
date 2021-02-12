<?php


function getPokemonType(array $data): array
{
    $temp = $data['temp'];

    if ($temp < 5) {
        $type = 'ice';
        $theme = 'yeti';
    } else if ($temp >= 5 && $temp < 10) {
        $type = 'water';
        $theme = 'cerulean';
    } else if ($temp > 12 && $temp < 15) {
        $type = 'grass';
        $theme = 'lumen';
    } else if ($temp > 15 && $temp < 21) {
        $type = 'ground';
        $theme = 'slate';
    } else if ($temp > 23 && $temp < 27) {
        $type = 'bug';
        $theme = 'minty';
    } else if ($temp > 27 && $temp < 33) {
        $type = 'rock';
        $theme = 'sandstone';
    } else if ($temp > 33) {
        $type = 'fire';
        $theme = 'journal';
    } else {
        $type = 'normal';
        $theme = 'cosmo';
    }
    if ($data['raining']) {
        $type = 'electric';
        $theme = 'superhero';

    }

    return [
        'type' => $type,
        'theme' => $theme
    ];
}