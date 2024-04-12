<?php
// Retrieve data from AJAX request
$username = $_POST['username'];

// Perform validation
// Example: Check if the username is already taken in the database
$valid = true; // Perform your validation logic here

// Send JSON response
header("Content-Type: application/json");
echo json_encode(array("valid" => $valid));
?>
