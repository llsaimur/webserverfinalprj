<?php
// Retrieve data from AJAX request
$password = $_POST['password'];

// Perform validation
$valid = strlen($password) >= 8;
$message = $valid ? "" : "Invalid password Must be 8 character long";

// Send JSON response
header("Content-Type: application/json");
echo json_encode(array(
    "valid" => $valid,
    "fieldName" => "password",
    "message" => $message    
));
?>
