<?php
require "/membri/recipie/connection.php";

$id = $_POST["id"];
$name = $_POST["name"];
$type = $_POST["type"];
$capacity = $_POST["capacity"];

query(
    $query = "
        UPDATE Container
        SET name = ?,
        type = ?,
        capacity = ?
        WHERE id = ?
    ",
    $types = "ssii",
    $name, $type, $capacity, $id
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
