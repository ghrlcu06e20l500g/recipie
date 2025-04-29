<?php
require "/membri/recipie/connection.php";

$id = $_POST["id"];

query(
    $query = "
        DELETE FROM Container
        WHERE id = ?
    ",
    $types = "i",
    $id
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
