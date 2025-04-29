<?php

require "/membri/recipie/connection.php";
require "/membri/recipie/utils.php";

$id = $_GET["id"];
if($id == null) {
	header("Location: 404.php");
}

// load recipe
$result = query(
    $query = "
        SELECT r.name AS name, r.portions as portions, u.username AS username, u.id AS userId
        FROM Recipe as r, User as u
        WHERE r.userId = u.id
        AND r.id = ?
    ", 
    $types = "i",
    $id
);
if(empty($result)) {
	header("Location: 404.php");
}
$recipe = $result[0];
$currentUser = $recipe["userId"] == $_SESSION["user"]["id"];

// load bookmark state
$bookmarked = query(
    $query = "
        SELECT *
        FROM Bookmark
        WHERE userId = ?
        AND recipeId = ?
    ",
    $types = "ii",
    $_SESSION["user"]["id"],
    $id
);

// load recipe ingredients
$recipeIngredients = query(
    $query = "
        SELECT ri.*, i.*
        FROM RecipeIngredient AS ri, Ingredient AS i
        WHERE ri.ingredientId = i.id
        AND ri.recipeId = ?
        ORDER BY ri.quantity DESC
    ",
    $types = "i",
    $id
);

// load recipe containers
$recipeContainers = query(
    $query = "
        SELECT *
        FROM Container
        WHERE recipeId = ?
    ",
    $types = "i",
    $id
);

$recipeSteps = query(
    $query = "
        SELECT
            s.id                AS id,
            s.action            AS action,
            i.name              AS ingredientName,
            i.measurementType   AS measurementType,
            c.name              AS containerName,
            s.minutes           AS minutes,
            s.quantity          AS quantity
        FROM Step AS s
        LEFT JOIN Ingredient AS i
            ON i.id = s.recipeIngredientId
        LEFT JOIN Container AS c
            ON c.id = s.containerId
        WHERE s.recipeId = ?
        ORDER BY s.id
    ",
    "i",
    $id
);

?>
