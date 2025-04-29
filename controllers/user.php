<?php

require "/membri/recipie/connection.php";
require "/membri/recipie/utils.php";

$id = $_GET["id"];
if($id == null) {
	header("Location: 404.php");
}

// load user
$result = query(
    $query = "
        SELECT *
        FROM User
        WHERE id = ?
    ",
    $types = "i",
    $id
);
if(empty($result)) {
	header("Location: 404.php");
}
$user = $result[0];

$profilePictureSrc = null;
if(!empty($user["profilePicture"])) {
    $base64 = base64_encode($user["profilePicture"]);
    $profilePictureSrc = "data:image/jpeg;base64," . $base64;
}

$currentUser = $user["id"] == $_SESSION["user"]["id"];

// load user allergens
$userAllergens = query(
    $query = "
        SELECT a.*
        FROM UserAllergen AS ua, Allergen AS a
        WHERE ua.allergenId = a.id
        AND userId = ?
    ",
    $types = "i",
    $id
);

// load user disliked ingredients
$userDislikedIngredients = query(
    $query = "
        SELECT i.*
        FROM UserDislikedIngredient AS ui, Ingredient AS i
        WHERE ui.ingredientId = i.id
        AND userId = ?
    ",
    $types = "i",
    $id
);

// load user liked ingredients
$userLikedIngredients = query(
    $query = "
        SELECT i.*
        FROM UserLikedIngredient AS ui, Ingredient AS i
        WHERE ui.ingredientId = i.id
        AND userId = ?
    ",
    $types = "i",
    $id
);

// load user loved ingredients
$userLovedIngredients = query(
    $query = "
        SELECT i.*
        FROM UserLovedIngredient AS ui, Ingredient AS i
        WHERE ui.ingredientId = i.id
        AND userId = ?
    ",
    $types = "i",
    $id
);

// load user recipes
$userRecipes = query(
    $query = "
        SELECT *
        FROM Recipe
        WHERE userId = ?
    ",
    $types = "i",
    $id
);

?>
