<?php

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password submitted from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashed_password = md5($password);

// Construct the SQL query
$sql = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Incorrect username or password!";
}

$conn->close();
?>
