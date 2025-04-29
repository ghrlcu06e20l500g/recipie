<?php

function suffix(string $measurementType): string {
	switch($measurementType) {
        case "QUANTITY": return "";
        case "WEIGHT": return "g";
        case "VOLUME": return "ml";
        default:
      	    throw new Exception($measurementType." is an invalid measurement type.");
    };
}
function loadIngredients(): array | null {
    require "/membri/recipie/views/connect.php";

    $statement = $connection -> prepare("
    	SELECT id, name
        FROM Ingredient
        ORDER BY name
    ");
    $statement -> execute();
    $result = $statement -> get_result();
    
    if($result -> num_rows == 0) {
        return null;
    } else {
        return $result -> fetch_all(MYSQLI_ASSOC);
    }
}
function loadAllergens(): array | null {
    require "/membri/recipie/views/connect.php";

    $statement = $connection -> prepare("
    	SELECT id, name
        FROM Allergen
        ORDER BY name
    ");
    $statement -> execute();
    $result = $statement -> get_result();
    
    if($result -> num_rows == 0) {
        return null;
    } else {
        return $result -> fetch_all(MYSQLI_ASSOC);
    }
}

?>
