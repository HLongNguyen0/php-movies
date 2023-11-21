<?php

switch($_SESSION["movieList"]) {
    case "search":
        require "php/api/api-search.php";
        break;
    case "popularMovies":
        require "php/api/api-popular.php";
        break;
    case "popularTVs":
        require "php/api/api-popular.php";
        break;
    case "topRatedMovies":
        require "php/api/api-topRated.php";
        break;
    case "topRatedTVs":
        require "php/api/api-topRated.php";
        break;
    case "upcoming":
        require "php/api/api-upcoming.php";
        break;
    default:
        require "layout/error.php";
}

$data = json_decode($response->getBody())->results;
$lastPage = json_decode($response->getBody())->total_pages;
?>
<section class="movies">
    <?php
    require "movie-sort.php";
    ?>
    <div class="container">
        <ul class="movies__list">
            <?php
            foreach($data as $movie) {
                    echo "
                    <li class='movies__card'>
                        <img class='movies__card__img' src='https://image.tmdb.org/t/p/w300" . $movie->poster_path . "' alt='movie image'>
                        <div class='card__text'>
                            <h2 class='card__name'>" . ($movie->original_title ?? $movie->original_name) . "</h2>
                            <span class='card__year'>" . ($movie->release_date ?? $movie->first_air_date) . "</span>
                            <span class='card__vote'>" . round($movie->vote_average, 1) . "/10 </span>
                        </div>
                    </li>
                ";
            }
            ?> 
        </ul>
    </div>
</section>