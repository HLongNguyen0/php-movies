<?php

session_start();

if ($_SESSION["currPage"] !== $currPage) {
    $_SESSION["currPage"] = $currPage;
    if ($currPage == "index") {
        $_SESSION["movieList"] = "popularMovies";
    }
    if ($currPage == "library") {
        $_SESSION["movieList"] = "queuedMovies";
        $_SESSION["movieLib"] = "queue";
    }
    if (!isset($_SESSION["page"])) {
        $_SESSION["page"] = 1;
    }
}
