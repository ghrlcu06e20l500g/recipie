<?php 

require "/membri/recipie/utils.php";
require "/membri/recipie/connection.php";

$search = $_GET["search"] ?? "";
$searchFor = $_GET["searchFor"] ?? "recipe";

$orderRecipeBy = $_GET["orderRecipeBy"] ?? "name";
$recipeDesc = ($_GET["recipeDesc"] == null)? false: true;
$includeIngredients = $_GET["includeIngredients"] ?? [];
$excludeIngredients = $_GET["excludeIngredients"] ?? (
    ($_SESSION["user"] != null) ? 
        array_column(
            query(
                $query = "
                    SELECT ingredientId
                    FROM UserDislikedIngredient
                    WHERE userId = ?
                ", 
                $types = "i", 
                $_SESSION["user"]["id"]
            ), "ingredientId"
        ) 
    : []
);
$excludeAllergens = $_GET["excludeAllergens"] ?? (
    ($_SESSION["user"] != null) ? 
        array_column(
            query(
                $query = "
                    SELECT allergenId
                    FROM UserAllergen
                    WHERE userId = ?
                ", 
                $types = "i", 
                $_SESSION["user"]["id"]
            ), "allergenId"
        ) 
    : []
);

$orderUserBy = $_GET["orderUserBy"] ?? "username";
$userDesc = ($_GET["userDesc"] == null)? false: true;

function loadRecipes(): array {
    global
        $search,
        $orderRecipeBy,
        $recipeDesc,
        $includeIngredients,
        $excludeIngredients, $insideIf
    ;

    $comparator = ($search === "")? "%": "%".$search."%";

    $query = "
        SELECT r.*, u.username AS username, u.id AS userId
        FROM Recipe AS r, User AS u
        WHERE r.userId = u.id 
        AND r.name LIKE ?
    ";

    if(!empty($includeIngredients)) {
        $includeIngredientsIdList = implode(", ", $includeIngredients);
        $query .= "
            AND r.id IN (
                SELECT r.id
                FROM Recipe AS r, RecipeIngredient AS ri
                WHERE ri.recipeId = r.id
                AND ri.ingredientId IN ($includeIngredientsIdList)
                GROUP BY r.id
            )
        ";
    }
    if(!empty($excludeIngredients)) {
        $excludeIngredientsIdList = implode(", ", $excludeIngredients);
        $query .= "
            AND r.id NOT IN (
                SELECT r.id
                FROM Recipe AS r, RecipeIngredient AS ri
                WHERE ri.recipeId = r.id
                AND ri.ingredientId IN ($excludeIngredientsIdList)
                GROUP BY r.id
            )
        ";
    }
    if(!empty($excludeAllergens)) {
        $excludeAllergensIdList = implode(", ", $excludeAllergens);
        $query .= "
            AND r.id NOT IN (
                SELECT r.id
                FROM Recipe AS r, RecipeIngredient AS ri, Ingredient AS i, IngredientAllergen AS ia
                WHERE ri.recipeId = r.id
                AND ri.ingredientId = i.id
                AND ia.ingredientId = i.id
                AND ia.allergenId IN ($excludeAllergensIdList)
                GROUP BY r.id
            )
        ";
    }

    $query .= "ORDER BY $orderRecipeBy";
        
    if($recipeDesc) {
        $query .= " DESC ";
    }
    return query($query, "s", $comparator);
}

function loadUsers(): array {
    global
        $search,
        $orderUserBy,
        $userDesc
    ;

    $comparator = ($search === "")? "%": "%".$search."%";
    $query = "
        SELECT u.*, COUNT(*) AS recipeNumber
        FROM User AS u, Recipe AS r
        WHERE u.username LIKE ?
        GROUP BY u.id
        ORDER BY $orderUserBy
    ";
    if($userDesc) {
        $query .= " DESC ";
    }
    return query($query, "s", $comparator);
}

?>
