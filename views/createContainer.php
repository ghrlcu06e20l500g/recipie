<?php
require "/membri/recipie/connection.php";

$recipeId = $_POST["recipeId"];
$name = $_POST["name"];
$type = $_POST["type"];
$capacity = $_POST["capacity"];

query(
    $query = "
        INSERT INTO Container(recipeId, name, type, capacity)
        VALUES(?, ?, ?, ?)
    ",
    $types = "issi",
    $recipeId, $name, $type, $capacity    
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
