<?php 

include "/membri/recipie/connection.php";

$id = $_POST["id"];

query(
    $query = "
        UPDATE User
        SET profilePicture = NULL
        WHERE id = ?;
    ",
    "i",
    $id
);

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
