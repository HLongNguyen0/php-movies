<?php

switch($_SESSION["movieList"]) {
    case "popular":
        require "php/api/api-popular.php";
        break;
    case "search":
        require "php/api/api-search.php";
        break;
    default:
        require "php/api/api-popular.php";
}

$data = json_decode($response->getBody())->results;

?>
<section class="movies">
    <div class="container">
        <ul class="movies__list">
            <?php
            foreach($data as $movie) {
                    echo "
                    <li class='movies__card'>
                        <img class='movies__card__img' src='https://image.tmdb.org/t/p/w300" . $movie->poster_path . "' alt='movie image'>
                        <div class='card__text'>
                            <h2 class='card__name'>" . $movie->original_title . "</h2>
                            <span class='card__year'>" . $movie->release_date . "</span>
                            <span class='card__vote'>" . round($movie->vote_average, 1) . "/10 </span>
                        </div>
                    </li>
                ";
            }
            ?> 
        </ul>
    </div>
</section>