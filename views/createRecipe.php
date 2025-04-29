<?php

session_start();
require "connect.php";
$statement = $connection -> prepare("
    INSERT INTO Recipe(userId, name, portions)
    VALUES(?, 'Unnamed Recipe', 4)
");
$statement->bind_param('i', $_SESSION["user"]["id"]);
$statement -> execute();
header("Location: recipe.php?id=".($connection -> insert_id));
