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

var_dump([
    'action'             => $action,
    'recipeIngredientId' => $recipeIngredientId,
    'quantity'           => $quantity,
    'containerId'        => $containerId,
    'minutes'            => $minutes,
    'id'                 => $id,
    'recipeId'           => $recipeId,
]);

echo var_dump(query(
    $query = "
        SELECT *
        FROM Step
        WHERE id = ?
        AND recipeId = ?
    ",
    "ii",
    6, 1
));

query(
    $query = "
        UPDATE Step
        SET action = ?,
            recipeIngredientId = ?,
            quantity = ?,
            containerId = ?,
            minutes = ?
        WHERE id = ?
        AND recipeId = ?
    ",
    "siiiiii",
    $action, $recipeIngredientId, $quantity, $containerId, $minutes, $id, $recipeId
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
