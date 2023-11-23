<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && ($_POST["watched"] || $_POST["queue"])) {
    if ($currPage == 'index') require_once "php/mysql/mysql.php";
    else require_once "../php/mysql/mysql.php";
    if ($_POST["watched"]) {
        $cardId = $_POST["watched"];
        $watched = 1;
    } else {
        $cardId = $_POST["queue"];
        $watched = 0;
    }

    $sql = "SELECT movie_watched FROM movies WHERE id = $cardId;";
    try {
        $movies = mysqli_fetch_assoc(mysqli_query($connect, $sql));
    } catch (\Throwable $th) {
        echo "Coundn't fetch 0<br>";
        echo $th;
    }

    if (!$movies) {
        foreach ($data as $movie) {
            if ($movie->id == $cardId) {
                $movieTitle = '"' . ($movie->original_title ?? $movie->original_name) . '"';
                $sql = "INSERT INTO `movies`(`id`, `movie_watched`, `movie_title`, `movie_poster`, `movie_film`) 
                        VALUES ($cardId,$watched,$movieTitle,'$movie->poster_path','" . $_SESSION["movieList"] . "')";
                try {
                    mysqli_query($connect, $sql);
                } catch (\Throwable $th) {
                    echo "Coundn't fetch 1<br>";
                    echo $th;
                }
                break;
            } 
        }
    } else {
        $sql = "UPDATE `movies` 
                SET `movie_watched` = $watched
                WHERE id = $cardId";
        try {
            mysqli_query($connect, $sql);
        } catch (\Throwable $th) {
            echo "Coundn't fetch 2<br>";
            echo $th;
        }
    }
}