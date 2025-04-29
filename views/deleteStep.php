<?php 

require "/membri/recipie/connection.php";

$id = $_POST["id"];
$recipeId = $_POST["recipeId"];

query(
    $query = "
        DELETE FROM Step
        WHERE id = ?
        AND recipeId = ?
    ",
    "ii",
    $id, $recipeId
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
