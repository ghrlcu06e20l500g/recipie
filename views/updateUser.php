<?php

require "/membri/recipie/connection.php";

$id = $_POST["id"];
$email = $_POST["email"];
$username = $_POST["username"];
$changePassword = $_POST["changePassword"] === "on";
$password = ($changePassword) ? (($_POST["password"] !== "") ? $_POST["password"] : null) : null;
$profilePicture = $_FILES['profilePicture'];

$query = "
    UPDATE User
    SET email = ?, username = ?
";
$types = "ss";
$attributes = [$email, $username];

if ($password !== null) {
    $query .= ", password = SHA2(?, 256)";
    $types .= "s";
    $attributes[] = $password;
}

$hasImage = false;
if ($profilePicture && $profilePicture['error'] == UPLOAD_ERR_OK) {
    $imageData = file_get_contents($profilePicture['tmp_name']);
    $query .= ", profilePicture = ?";
    $types .= "s";
    $attributes[] = $imageData;
    $hasImage = true;
}

$query .= " WHERE id = ?";
$types .= "i";
$attributes[] = $id;

$connection = new mysqli("localhost", "recipie", "", "my_recipie");
if($connection -> connect_error) {
    die("Failed to establish connection: " . $connection->connect_error);
}

$statement = $connection->prepare($query);
if(!$statement) {
    die("Failed to prepare statement.");
}

$statement->bind_param($types, ...$attributes);

if($hasImage) {
    $imageIndex = array_search($imageData, $attributes, true);
    $statement -> send_long_data($imageIndex, $imageData);
}

$statement -> execute();
$statement -> close();
$connection -> close();

header("Location: " . ($_SERVER["HTTP_REFERER"] ?? ""));
exit;

?>