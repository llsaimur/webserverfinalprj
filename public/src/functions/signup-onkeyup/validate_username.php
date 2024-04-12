<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidsgames";

// Initialize response
$response = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from AJAX request
$username = $_POST['username'];

// Prepare and execute query to check if username exists
$stmt = $conn->prepare("SELECT * FROM player WHERE userName = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if username exists
if ($result->num_rows > 0) {
    // Username already exists
    $valid = false;
    $message = "Username already exists";
} else {
    // Username is available
    $valid = true;
    $message = "Username is available";
}

// Close statement and connection
$stmt->close();
$conn->close();

// Send JSON response
header("Content-Type: application/json");
echo json_encode(array(
    "valid" => $valid,
    "fieldName" => "username",
    "message" => $message
));
?>
