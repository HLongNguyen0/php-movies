<?php

$sortArr = [
    "popularMovies" => "Popular Movies",
    "popularTVs" => "Popular TVShows",
    "topRatedMovies" => "Top rated Movies",
    "topRatedTVs" => "Top rated TVShows",
    "upcoming" => "Upcoming"
];
?>

<div class="container">
    <form class="sort" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <ul class="sort__list">
            <?php
            foreach ($sortArr as $key => $value) {
                if ($key == $_SESSION["movieList"]) {
                    echo "
                    <li class='sort__elem'>
                        <button class='sort__button sort__button-curr' type='submit' name='movieList' value=" . $key .">" . $value ."</button>
                    </li>
                    ";    
                } else {
                    echo "
                    <li class='sort__elem'>
                        <button class='sort__button' type='submit' name='movieList' value=" . $key .">" . $value ."</button>
                    </li>
                    ";    
                }
            }
            ?>
        </ul>
    </form>
</div>