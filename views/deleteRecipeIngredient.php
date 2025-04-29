<?php

$recipeId = $_POST["recipeId"];
$ingredientId = $_POST["ingredientId"];

require "/membri/recipie/views/connect.php";

$statement = $connection->prepare("
    DELETE FROM RecipeIngredient
    WHERE recipeId = ? AND ingredientId = ?
");
$statement -> bind_param("ii", $recipeId, $ingredientId);
$statement -> execute();
header("Location: " . ($_SERVER["HTTP_REFERER"] ?? ""));