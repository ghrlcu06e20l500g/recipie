<?php

require "/membri/recipie/connection.php";

$id = $_POST["id"];

query("
    DELETE FROM User
    WHERE id = ?
");

header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));

?>
