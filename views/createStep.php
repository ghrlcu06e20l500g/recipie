<?php 

require "/membri/recipie/connection.php";

$id = $_POST["id"];
$recipeId = $_POST["recipeId"];
$action = ($_POST["action"] !== "")? $_POST["action"]: null;
$recipeIngredientId = ($_POST["recipeIngredientId"] !== "")? $_POST["recipeIngredientId"]: null;
$specifyQuantity = ($recipeIngredientId != null)? $_POST["specifyQuantity"] === "on": false;
$quantity = ($specifyQuantity)? (($_POST["quantity"] !== "")? $_POST["quantity"]: null): null;
$containerId = ($_POST["containerId"] !== "")? $_POST["containerId"]: null;
$specifyMinutes = $_POST["specifyMinutes"] === "on";
$minutes = ($specifyMinutes)? $_POST["minutes"]: null;

query(
    $query = "
        INSERT INTO Step(id, recipeId, action, recipeIngredientId, quantity, containerId, minutes)
        VALUES(?, ?, ?, ?, ?, ?, ?)
    ",
    "iisiiii",
    $id, $recipeId, $action, $recipeIngredientId, $quantity, $containerId, $minutes
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));
?>
