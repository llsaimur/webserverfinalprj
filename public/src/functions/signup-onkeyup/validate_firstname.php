<?php
$firstName = $_POST['firstName'];

// Perform validation
$valid = ctype_alpha($firstName[0]);
$message = $valid ? "" : "Invalid first name";

// Send JSON response
header("Content-Type: application/json");
echo json_encode(array(
    "valid" => $valid,
    "fieldName" => "firstName",
    "message" => $message
));
?>
