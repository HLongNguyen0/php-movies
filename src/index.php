<?php

require "php/session.php";

$currPage = 'index';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !($_POST["watched"] || $_POST["queue"])) {
    if (isset($_POST["search"])) {
        $_SESSION["movieList"] = "search";
        $_SESSION["search"] = $_POST["search"];
    }
    if (isset($_POST["movieList"])) $_SESSION["movieList"] = $_POST["movieList"];
    $_SESSION["page"] = 1;
    if (isset($_POST["pagination"])) $_SESSION["page"] = $_POST["pagination"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./styles/css/main.css">

</head>
<body>
    <?php
    
    require "layout/header.php";
    require "layout/main.php";
    
    ?>
</body>
<script src="./php/modal.js"></script>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && ($_POST["watched"] || $_POST["queue"])) {
    require_once "php/mysql.php";
    
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
        echo "Coundn't fetch <br>";
        echo $th;
    }

    if (!$movies) {
        foreach ($data as $movie) {
            if ($movie->id == $cardId) {
                $movieTitle = '"' . ($movie->original_title ?? $movie->original_name) . '"';
                $sql = "INSERT INTO `movies`(`id`, `movie_watched`, `movie_title`, `movie_poster`) 
                        VALUES ($cardId,$watched,$movieTitle,'$movie->poster_path')";
                try {
                    mysqli_query($connect, $sql);
                } catch (\Throwable $th) {
                    echo "Coundn't fetch <br>";
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
            echo "Coundn't fetch <br>";
            echo $th;
        }
    }


}
?>