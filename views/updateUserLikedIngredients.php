<?php 

include "/membri/recipie/connection.php";

$userId = $_POST["userId"] ?? null;
$likedIngredients = $_POST["likedIngredients"] ?? [];

query("DELETE FROM UserLikedIngredient WHERE userId = ?", "i", $userId);

if(!empty($likedIngredients)) {
    $query = "INSERT INTO UserLikedIngredient(userId, ingredientId) VALUES ";
    $types = "";
    $values = [];

    foreach($likedIngredients as $ingredient) {
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
