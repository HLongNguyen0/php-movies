<?php

require "api.php";
require "keys.php";

$response = $client->request('GET',
"https://api.themoviedb.org/3/search/movie?query=" . $_SESSION["search"] ."&include_adult=false&language=en-US&page=" . $_SESSION["page"],
[
    'headers' => [
      'Authorization' => 'Bearer ' . API_KEY,
      'accept' => 'application/json',
    ],
]);
