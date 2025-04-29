<?php 

require "/membri/recipie/connection.php";

$id = $_POST["id"];
$name = $_POST["name"];
$portions = $_POST["portions"];

query(
    $query = "
        UPDATE Recipe
        SET name = ?, portions = ?
        WHERE id = ?
    ",
    "sii",
    $name, $portions, $id
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
