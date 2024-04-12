<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['registrationOrder'])) {
    // Set livesUsed to 0 if it's not set
    $livesUsed = isset($_SESSION['livesUsed']) ? $_SESSION['livesUsed'] : 0;
    
    // Record the game as "Incomplete" in the database
    recordResult("Incomplete", $livesUsed, $_SESSION['registrationOrder']);
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page
header("Location: ../../../index.php");
exit;



// Function to record the result in the database
function recordResult($outcome, $livesUsed, $registrationOrder) {
    // Database connection
    $conn = connectToDatabase(); // Implement this function according to your database connection method

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO score (scoreTime, result, livesUsed, registrationOrder) VALUES (NOW(), :result, :livesUsed, :registrationOrder)");

    // Bind parameters
    $stmt->bindParam(':result', $outcome);
    $stmt->bindParam(':livesUsed', $livesUsed);
    $stmt->bindParam(':registrationOrder', $registrationOrder);

    // Execute the statement
    $stmt->execute();

    // Close connection
    $conn = null;
}

// Function to connect to the database
function connectToDatabase() {
    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "kidsgames"; // Replace with your database name

    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Return the connection object
        return $conn;
    } catch(PDOException $e) {
        // If connection fails, print the error message
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
?>
