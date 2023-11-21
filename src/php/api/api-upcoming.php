<?php

require "api.php";
require "keys.php";

$response = $client->request('GET', 
'https://api.themoviedb.org/3/movie/upcoming?language=en-US&include_adult=false&page=' . $_SESSION["page"],
[
  'headers' => [
    'Authorization' => 'Bearer ' . API_KEY,
    'accept' => 'application/json',
  ],
]);
