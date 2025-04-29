<?php

require "/membri/recipie/connection.php";

$recipeId = $_POST["recipeId"];
$ingredientId = $_POST["ingredientId"];
$quantityNull = $_POST["quantityNull"];
$quantity = ($quantityNull === "on")? null: $_POST["quantity"];

query(
    $query = "
        INSERT INTO RecipeIngredient(recipeId, ingredientId, quantity)
        VALUES(?, ?, ?)
    ",
    $types = "iii",
    $recipeId,
    $ingredientId,
    $quantity
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
