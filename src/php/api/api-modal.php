<?php

require "../../../vendor/autoload.php";
require "keys.php";

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Client;

$client = new Client();


$data = json_decode(ServerRequest::fromGlobals()->getBody(), true);


$response = $client->request('GET',
'https://api.themoviedb.org/3/movie/' . $data["movieId"] . '/external_ids',
[
  'headers' => 
  [
    'Authorization' => 'Bearer ' . API_KEY,
    'accept' => 'application/json',
  ],
]);

$externalId = json_decode($response->getBody())->imdb_id;


$response = $client->request('GET',
'https://api.themoviedb.org/3/find/' . $externalId .'?external_source=imdb_id',
[
  'headers' => 
  [
    'Authorization' => 'Bearer ' . API_KEY,
    'accept' => 'application/json',
  ],
]);

$result = json_decode($response->getBody())->movie_results[0];

var_dump($result);

echo "
<span class='closeModal'>X</span>
<h1>Title : $result->title</h1>
"
?>
