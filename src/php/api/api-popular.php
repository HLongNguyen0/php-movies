<?php

require "api.php";
require "keys.php";

if ($_SESSION["movieList"] == "popularMovies") {
    $url = 'https://api.themoviedb.org/3/movie/popular?language=en-US&include_adult=false&page=';
} else {
    $url = 'https://api.themoviedb.org/3/tv/popular?language=en-US&include_adult=false&page=';
}


$response = $client->request('GET', 
$url . $_SESSION["page"], 
[
    'headers' => [
        'Authorization' => "Bearer " . API_KEY,
        'accept' => 'application/json',
    ],
    ]
);

