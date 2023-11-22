<?php

require_once "../../../vendor/autoload.php";
require_once "keys.php";

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Client;

$client = new Client();


$data = json_decode(ServerRequest::fromGlobals()->getBody(), true);

if ($data["movieList"] == "popularTVs" || $data["movieList"] == "topRatedTVs") {
  $film = "tv";
} else {
  $film = "movie";
}

try {
  $response = $client->request('GET',
  'https://api.themoviedb.org/3/' . $film .'/' . $data["movieId"] . '/external_ids',
  [
    'headers' => 
    [
      'Authorization' => 'Bearer ' . API_KEY,
      'accept' => 'application/json',
    ],
  ]);
} catch (\Throwable $th) {
  echo "<span class='closeModal'>X</span>";
  echo "<h1>Something went wrong 1</h1>";
  return;
}

$externalIds = json_decode($response->getBody());

foreach ($externalIds as $key => $externalId) {
  if ($key == "id") continue;
  if ($externalId != null) {
    $id = $externalId;
    $filmdb = $key;
    break;
  }
}

try {
  $response = $client->request('GET',
  'https://api.themoviedb.org/3/find/' . $id .'?external_source=' . $filmdb,
  [
    'headers' => 
    [
      'Authorization' => 'Bearer ' . API_KEY,
      'accept' => 'application/json',
    ],
  ]);
} catch (\Throwable $th) {
  echo "<span class='closeModal'>X</span>";
  echo "<h1>Something went wrong 2</h1>";
  return;
}

$result = json_decode($response->getBody())->movie_results[0] 
?? json_decode($response->getBody())->tv_results[0];

// var_dump($result);

echo "
<span class='closeModal'>X</span>
<img class='modal__img' src='https://image.tmdb.org/t/p/w300" . $result->poster_path . "' alt=''>
<div class='modal__info'>
  <h1 class='modal__title'>" . ($result->original_title ?? $result->original_name) . "</h1>
  <span class='modal__text'><span class='modal__value'>Release date :</span> " . ($result->release_date ?? $result->first_air_date) . "</span>
  <span class='modal__text'><span class='modal__value'>Original language :</span> " . $result->original_language . "</span>
  <span class='modal__text'><span class='modal__value'>Popularity :</span> " . $result->popularity . "</span>
  <span class='modal__text'><span class='modal__value'>Votes :</span> " . round($result->vote_average, 1) . "/10 (" . $result->vote_count . " votes)</span>
  <span class='modal__text'><span class='modal__value'>About :</span></span>
  <p class='modal__about'>" . $result->overview . "</p>
</div>
"
?>