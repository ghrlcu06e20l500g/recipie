<?php

$recipeId = $_POST["recipeId"];
$ingredientId = $_POST["ingredientId"];
$quantityNull = $_POST["quantityNull"];
$quantity = ($quantityNull === "on")? null: $_POST["quantity"];

require "/membri/recipie/views/connect.php";
$statement = $connection -> prepare("
    UPDATE RecipeIngredient
    SET quantity = ?,
    ingredientId = ?
    WHERE recipeId = ?
    AND ingredientId = ?
");
$statement -> bind_param("iiii", $quantity, $ingredientId, $recipeId, $ingredientId);
$statement -> execute();
header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));
