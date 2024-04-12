<?php
// Establish database connection (Replace placeholders with actual values)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidsgames";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Perform server-side validation
$errors = array();

if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirmPassword)) {
    $errors[] = "All fields are required.";
}

if (!ctype_alpha($firstName[0]) || !ctype_alpha($lastName[0]) || !ctype_alpha($username[0])) {
    $errors[] = "First Name, Last Name, and Username must start with a letter.";
}

if (strlen($username) < 8 || strlen($password) < 8) {
    $errors[] = "Username and Password must be at least 8 characters long.";
}

if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
}

// Check if username already exists
$sql = "SELECT * FROM player WHERE userName='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $errors[] = "Username already exists.";
}

// If no errors, insert data into database
if (empty($errors)) {
    // Insert user into player table
    $sql = "INSERT INTO player (fName, lName, userName, registrationTime) VALUES ('$firstName', '$lastName', '$username', now())";
    if ($conn->query($sql) === TRUE) {
        // Insert password into authenticator table
        $passCode = password_hash($password, PASSWORD_DEFAULT);
        $registrationOrder = $conn->insert_id; // Get the auto-generated registrationOrder
        $sql = "INSERT INTO authenticator (passCode, registrationOrder) VALUES ('$passCode', '$registrationOrder')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful! Redirecting to home page...";
            header("refresh:3;url=../../form/login.php"); // Redirect to home page after 3 seconds
            exit();
        } else {
            echo "Error inserting password: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error inserting user: " . $sql . "<br>" . $conn->error;
    }
} else {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
$conn->close();
?>
