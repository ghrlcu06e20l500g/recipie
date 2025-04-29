<?php
session_start();
require "connect.php";
$statement = $connection -> prepare("
    DELETE FROM Bookmark
    WHERE userId = ?
    AND recipeId = ?
");
$statement -> bind_param('ii', $_SESSION["user"]["id"], $_POST["recipeId"]);
$statement -> execute();
header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));
