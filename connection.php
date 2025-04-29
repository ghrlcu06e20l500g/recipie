<?php

function query($query, $types = null, ...$_): array {
    $connection = new mysqli("localhost", "recipie", "", "my_recipie");
    if($connection -> connect_error) {
        die("Failed to establish connection.");
    }
    $statement = $connection -> prepare($query);
    if(!$statement) {
        die("Failed to create statement.");
    }
    if($types != null) {
        $statement -> bind_param($types, ...$_);
    }
    $statement -> execute();
    $result = $statement -> get_result();
    if(!$result) {
        return [];
    }

    $value = $result -> fetch_all(MYSQLI_ASSOC) ?? [];

    $result -> close();
    $statement -> close();
    $connection -> close();

    return $value;
}

?>
