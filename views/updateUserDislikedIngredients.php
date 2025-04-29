<?php 

include "/membri/recipie/connection.php";

$userId = $_POST["userId"] ?? null;
$dislikedIngredients = $_POST["dislikedIngredients"] ?? [];

query("DELETE FROM UserDislikedIngredient WHERE userId = ?", "i", $userId);

if(!empty($dislikedIngredients)) {
    $query = "INSERT INTO UserDislikedIngredient(userId, ingredientId) VALUES ";
    $types = "";
    $values = [];

    foreach($dislikedIngredients as $ingredient) {
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
