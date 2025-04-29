<?php

include "/membri/recipie/connection.php";

$id = $_POST["id"];
$diet = $_POST["diet"];

query("UPDATE User SET diet = ? WHERE id = ?", "si", $diet, $id);

header("Location: " . ($_SERVER["HTTP_REFERER"] ?? ""));

?>
