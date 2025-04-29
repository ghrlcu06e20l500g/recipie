<?php
session_start();
require_once "/membri/recipie/connection.php";

$username = $_POST["username"];
$password = $_POST["password"];

$result = query(
    $query = "
        SELECT *
        FROM User
        WHERE username = ?
    ", 
    $types = "s",
    $username
);

if(empty($result)) {
	$error = "Incorrect username.";
	header("Location: login.php?error=".urlencode($error));
    exit;
}

$result = query(
    $query = "
        SELECT *
        FROM User
        WHERE username = ?
        AND password = SHA2(?, 256)
    ", 
    $types = "ss",
    $username, 
    $password
);

if(empty($result)) {
	$error = "Incorrect password.";
	header("Location: login.php?error=".urlencode($error));
    exit;
}

$user = $result[0];
$_SESSION["user"] = $user;

header("Location: home.php");
