<?php

    require_once "../php/mysql.php";

    $sql = "SELECT * FROM `movies`;";
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
            <ul class='movies__list'>
            <?php
            foreach ($movies as $movie) {
                echo "
                <li class='movies__card'>
                    <img class='movies__card__img' src='https://image.tmdb.org/t/p/w300" . $movie[3] . "' alt='movie image'>
                    <div class='card__text' data-id=" . $movie[0] . ">
                        <h2 class='card__name'>" . $movie[2] . "</h2>
                    </div>
                </li>
                ";
            }
            ?>
            </ul>
        </div>
    </section>
</body>
</html>