<?php

session_start();

if (!isset($_SESSION["page"])) {
    $_SESSION["page"] = 1;
    $_SESSION["movieList"] = "popularMovies";
}
