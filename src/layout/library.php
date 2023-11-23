<?php

$currPage = "library";
require "../php/session.php";
require "../php/mysql/mysql.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["movieList"]) {
    if (isset($_POST["movieList"])) $_SESSION["movieList"] = $_POST["movieList"];
    $_SESSION["page"] = 1;
}

if ($_SESSION["movieList"] == "queuedMovies") $sql = "SELECT * FROM `movies` WHERE movie_watched = 0 AND (movie_film = 'popularMovies' OR movie_film = 'topRatedMovies');";
if ($_SESSION["movieList"] == "watchedMovies") $sql = "SELECT * FROM `movies` WHERE movie_watched = 1 AND (movie_film = 'popularMovies' OR movie_film = 'topRatedMovies');";
if ($_SESSION["movieList"] == "queuedTVs") $sql = "SELECT * FROM `movies` WHERE movie_watched = 0 AND (movie_film = 'popularTVs' OR movie_film = 'topRatedTVs');";
if ($_SESSION["movieList"] == "watchedTVs") $sql = "SELECT * FROM `movies` WHERE movie_watched = 1 AND (movie_film = 'popularTVs' OR movie_film = 'topRatedTVs');";

try {
    $movies = mysqli_fetch_all(mysqli_query($connect, $sql));
} catch (\Throwable $th) {
    echo "Coundn't fetch <br>";
    echo $th;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/css/main.css">
</head>
<body>
    <?php
    require "header.php";
    ?>
    <section class="movies">
        <div class="container">
            <?php
            require "modal.php";
            require "movie-sort.php";
            echo "
            <ul class='movies__list' data-list=" . $_SESSION['movieList'] . ">
            ";
            foreach ($movies as $movie) {
                echo "
                <li class='movies__card'>
                    <img class='movies__card__img' src='https://image.tmdb.org/t/p/w300" . $movie[3] . "' alt='movie image'>
                    <div class='card__text' data-id=" . $movie[0] . ">
                        <h2 class='card__name' data-id=" . $movie[0] . ">" . $movie[2] . "</h2>
                    </div>
                </li>
                ";
            }
            ?>
            </ul>
        </div>
    </section>
</body>
<script src="../php/modal.js"></script>
</html>

<?php
    require "php/mysql/mysql-save.php"
?>