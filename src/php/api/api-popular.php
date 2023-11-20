<?php

require "api.php";
require "keys.php";

$response = $client->request('GET', 
    'https://api.themoviedb.org/3/movie/popular?language=en-US&page=' . $_SESSION["page"], 
    [
        'headers' => [
        'Authorization' => "Bearer " . API_KEY,
        'accept' => 'application/json',
        ],
    ]
);
