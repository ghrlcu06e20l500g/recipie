<?php

session_start();
require "connect.php";
$statement = $connection -> prepare("
    DELETE FROM Recipe
    WHERE id = ?
");
$statement -> bind_param("i", $_POST["id"]);
$statement -> execute();
header("Location: user.php?id=".$_SESSION["user"]["id"]);
