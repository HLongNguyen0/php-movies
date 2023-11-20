<?php

session_start();

if (!isset($_SESSION["page"])) {
    $_SESSION["page"] = 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["page"])) $_SESSION["page"] = $_POST["page"];
    if (isset($_POST["movieList"])) $_SESSION["movieList"] = $_POST["movieList"];

}
