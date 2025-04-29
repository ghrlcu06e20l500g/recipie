<?php 

include "/membri/recipie/connection.php";

$userId = $_POST["userId"] ?? null;
$allergens = $_POST["allergens"] ?? [];

query("DELETE FROM UserAllergen WHERE userId = ?", "i", $userId);

if(!empty($allergens)) {
    $query = "INSERT INTO UserAllergen(userId, allergenId) VALUES ";
    $types = "";
    $values = [];

    foreach($allergens as $allergen) {
        $query .= "(?, ?),";
        $types .= "ii";
        $values[] = $userId;
        $values[] = $allergen;
    }

    $query = rtrim($query, ",");

    query($query, $types, ...$values);
}

header("Location: " . ($_SERVER["HTTP_REFERER"] ?? ""));
exit;

?>
