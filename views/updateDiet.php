<?php
session_start();
require "connect.php";
$statement = $connection -> prepare("
    UPDATE User
    SET diet = ?
    WHERE id = ?
");
$statement -> bind_param('si', $_POST["diet"], $_SESSION["user"]["id"]);
$statement -> execute();
$_SESSION["user"]["diet"] = $_POST["diet"];
header("Location: ".($_SERVER["HTTP_REFERER"] ?? ""));
