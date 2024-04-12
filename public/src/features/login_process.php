<?php
session_start();

// Check if username and password are set
if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: ../../form/login.php?error=Please%20fill%20in%20both%20username%20and%20password");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "kidsgames"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to retrieve user data
$stmt = $conn->prepare("SELECT p.registrationOrder, p.userName, a.passCode 
                       FROM player p
                       INNER JOIN authenticator a ON p.registrationOrder = a.registrationOrder
                       WHERE p.userName = ?");
$stmt->bind_param("s", $_POST['username']);
$stmt->execute();
$result = $stmt->get_result();

// Check if a row was returned
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($_POST['password'], $row['passCode'])) {
        // Authentication successful, start session
        $_SESSION['registrationOrder'] = $row['registrationOrder'];
        $_SESSION['username'] = $row['userName'];

        // Check if $_SESSION['registrationOrder'] is set correctly
        if (isset($_SESSION['registrationOrder'])) {
            // Redirect to level1 after successful login
        echo '<script>alert("Successful logged in!");</script>';
        echo '<script>window.location.href = "../../levels/level1.php";</script>';
       
            exit;
        } else {
            // If registration order is not set, redirect back to login with an error message
            header("Location: ../../form/login.php?error=Sorry,%20an%20error%20occurred.%20Please%20try%20logging%20in%20again.");
            exit;
        }
    } else {
        // Incorrect password
        header("Location: ../../form/login.php?error=Sorry,%20the%20username%20or%20password%20is%20incorrect!");
        exit;
    }
} else {
    // No user found with that username
    header("Location: ../../form/login.php?error=Sorry,%20the%20username%20or%20password%20is%20incorrect!");
    exit;
}

$stmt->close();
$conn->close();
?>
