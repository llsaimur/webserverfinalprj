<?php
// Retrieve data from AJAX request
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Perform validation
$valid = ($password === $confirmPassword);
$message = $valid ? "" : "Invalid password does not match";

// Send JSON response
header("Content-Type: application/json");
echo json_encode(array(
    "valid" => $valid,
    "fieldName" => "confirmPassword",
    "message" => $message
));
?>
