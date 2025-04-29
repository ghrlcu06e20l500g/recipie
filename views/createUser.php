<?php
session_start();
require "/membri/recipie/connection.php";

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$diet = $_POST["diet"];

$result = query(
    $query = "
        SELECT * FROM User
        WHERE username = ?
    ", 
    $types = "s",
    $username
);
if(!empty($result)) {
	header("Location: signup.php?error=".urlencode("User already Exists"));
    exit;
}

$result = query(
    $query = "
        SELECT * FROM User
        WHERE email = ?
    ", 
    $types = "s",
    $email
);
if(!empty($result)) {
	header("Location: signup.php?error=".urlencode("Email already Exists"));
    exit;
}


$result = query(
    $query = "
        INSERT INTO User(username, email, password, diet) VALUES
        (?, ?, SHA2(?, 256), ?)
    ", 
    $types = "ssss",
    $username,
    $email,
    $password,
    $diet
);

$user = $result[0];
$_SESSION["user"] = $user;

header("Location: home.php");

?>
