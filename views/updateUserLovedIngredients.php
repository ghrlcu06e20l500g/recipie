<?php 

include "/membri/recipie/connection.php";

$userId = $_POST["userId"] ?? null;
$lovedIngredients = $_POST["lovedIngredients"] ?? [];

query("DELETE FROM UserLovedIngredient WHERE userId = ?", "i", $userId);

if(!empty($lovedIngredients)) {
    $query = "INSERT INTO UserLovedIngredient(userId, ingredientId) VALUES ";
    $types = "";
    $values = [];

    foreach($lovedIngredients as $ingredient) {
        $query .= "(?, ?),";
        $types .= "ii";
        $values[] = $userId;
        $values[] = $ingredient;
    }

    $query = rtrim($query, ",");

    query($query, $types, ...$values);
}

header("Location: " . ($_SERVER["HTTP_REFERER"] ?? ""));
exit;

?>
