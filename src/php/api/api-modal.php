<?php

require_once "../../../vendor/autoload.php";
require_once "keys.php";
require_once "../mysql/mysql.php";

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Client;

$client = new Client();

$data = json_decode(ServerRequest::fromGlobals()->getBody(), true);

if ($data["movieList"] == "popularTVs" 
|| $data["movieList"] == "topRatedTVs"
|| $data["movieList"] == "queuedTVs"
|| $data["movieList"] == "watchedTVs"
) {
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


$sql = "SELECT movie_watched FROM movies WHERE id = $result->id;";
try {
    $movies = mysqli_fetch_assoc(mysqli_query($connect, $sql));
} catch (\Throwable $th) {
    echo "Coundn't fetch <br>";
    echo $th;
}


echo "
<span class='closeModal'>X</span>
<div class='modal__status'>
  <img class='modal__img' src='https://image.tmdb.org/t/p/w300" . $result->poster_path . "' alt='movie poster'>
";

echo "
  <form class='modal__form' method='POST' action='/src/index.php'>
";

if ($movies['movie_watched'] === '1') {
  echo "<button class='modal__btn modal__btn-curr' disabled>Already watched</button>";
} else {
  echo "<button class='modal__btn' name='watched' value=" . $result->id . ">Add to watched</button>";
}
if ($movies['movie_watched'] === '0') {
  echo "<button class='modal__btn modal__btn-curr' disabled>Already queued</button>";
} else {
  echo "<button class='modal__btn' name='queue' value=" . $result->id . ">Add to queue</button>";
}
echo "
  </form>
</div>
<div class='modal__info'>
  <h1 class='modal__title'>" . ($result->original_title ?? $result->original_name) . "</h1>
  <span class='modal__text'><span class='modal__value'>Release date :</span> " . ($result->release_date ?? $result->first_air_date) . "</span>
  <span class='modal__text'><span class='modal__value'>Original language :</span> " . $result->original_language . "</span>
  <span class='modal__text'><span class='modal__value'>Popularity :</span> " . $result->popularity . "</span>
  <span class='modal__text'><span class='modal__value'>Votes :</span> " . round($result->vote_average, 1) . "/10 (" . $result->vote_count . " votes)</span>
  <span class='modal__text'><span class='modal__value'>About :</span></span>
  <p class='modal__about'>" . $result->overview . "</p>
</div>
";
