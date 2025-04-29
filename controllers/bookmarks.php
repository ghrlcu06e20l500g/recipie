<?php

require "/membri/recipie/views/connect.php";

$statement = $connection -> prepare("
SELECT r.id AS recipeId, r.name AS recipeName, r.portions AS portions
FROM Recipe AS r, Bookmark AS b
WHERE b.recipeId = r.id
AND b.userId = ?
");
$statement -> bind_param("i", $_SESSION["user"]["id"]);
$statement -> execute();
$result = $statement -> get_result();
$bookmarks = $result -> fetch_all(MYSQLI_ASSOC) ?? [];

?>
