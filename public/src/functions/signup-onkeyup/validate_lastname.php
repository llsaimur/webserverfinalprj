<?php
$lastName = $_POST['lastName'];

// Perform validation
$valid = ctype_alpha($lastName[0]);
$message = $valid ? "" : "Invalid last name";

// Send JSON response
header("Content-Type: application/json");
echo json_encode(array(
    "valid" => $valid,
    "fieldName" => "lastName",
    "message" => $message
));
?>
