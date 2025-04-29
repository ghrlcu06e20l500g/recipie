<?php
session_start();
require "connect.php";
$statement = $connection -> prepare("
    INSERT INTO Bookmark(userId, recipeId)
    VALUES(?, ?)
");
$statement -> bind_param('ii', $_SESSION["user"]["id"], $_POST["recipeId"]);
$statement -> execute();
header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));
