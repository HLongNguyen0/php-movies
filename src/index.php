<?php

require "php/session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["pagination"])) $_SESSION["page"] = $_POST["pagination"];
    if (isset($_POST["movieList"])) $_SESSION["movieList"] = $_POST["movieList"];
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
</html>
