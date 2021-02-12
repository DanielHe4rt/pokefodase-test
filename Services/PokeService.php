<?php


class PokeService
{
    private $baseURI = "https://pokeapi.co/api/v2";
    private $client;

    public function __construct() {
        $this->client = curl_init();
        curl_setopt($this->client, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:85.0) Gecko/20100101 Firefox/85.0');
        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, true);
    }

    public function getPokemonByName(string $pokemonName): array
    {
        $uri = $this->baseURI . "/pokemon/$pokemonName";
        curl_setopt($this->client, CURLOPT_URL, $uri);
        return json_decode(curl_exec($this->client), true);
    }

    public function getPokemonsByType(string $type): array
    {
        $uri = $this->baseURI . "/type/$type";
        curl_setopt($this->client, CURLOPT_URL, $uri);
        return json_decode(curl_exec($this->client), true)['pokemon'];
    }
}