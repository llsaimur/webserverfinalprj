<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['registrationOrder'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../../form/login.php");
    exit;
}

// Function to validate user's input and determine outcome
function validateNumbers($givenNumbers, $smallestNumber, $largestNumber) {
    // Sort the given numbers in ascending order
    sort($givenNumbers);
    
    // Retrieve the smallest and largest numbers from the sorted array
    $smallest = $givenNumbers[0];
    $largest = end($givenNumbers);

    // Check if user identified the smallest and largest numbers correctly
    if ($smallest == $smallestNumber && $largest == $largestNumber) {
        return 'win'; // User wins
    } else {
        return 'game_over'; // User exhausted all lives without winning
    }
}

// Function to record the result in the database
function recordResult($outcome, $livesUsed, $registrationOrder) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kidsGames";

    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO score (scoreTime, result, livesUsed, registrationOrder) VALUES (NOW(), :result, :livesUsed, :registrationOrder)");
        
        // Bind the parameters
        $stmt->bindParam(':result', $outcome);
        $stmt->bindParam(':livesUsed', $livesUsed);
        $stmt->bindParam(':registrationOrder', $registrationOrder);
        
        // Execute the statement
        $stmt->execute();
        
        // Close the connection
        $conn = null;
        
        // Return true if insertion was successful
        return true;
    } catch(PDOException $e) {
        // Return false and print the error message if an error occurs
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the smallest and largest numbers identified by the user
    $smallestNumber = $_POST['smallestNumber'];
    $largestNumber = $_POST['largestNumber'];

    // Retrieve the given set of numbers stored in the session
    $givenNumbers = $_SESSION['givenNumbers'];

    // Validate user's input and determine the outcome
    $result = validateNumbers($givenNumbers, $smallestNumber, $largestNumber);

    // Redirect to game over page if user runs out of lives
    if ($result === 'game_over') {
        // Deduct a life
        $_SESSION['livesUsed']--;

        // If lives become zero, record game over and redirect
        if ($_SESSION['livesUsed'] == 0) {
            // Record "Game Over" in the database
            recordResult("Game Over", 6 - $_SESSION['livesUsed'], $_SESSION['registrationOrder']);
            // Redirect to game over page
            header("Location: ../../message/gameover.php");
            exit;
        }

        // User's input is invalid
        $_SESSION['error_message'] = "Invalid input! Please enter the largest (last) and smallest (first) numbers.";
        // Redirect back to the same level
        header("Location: ../../levels/level6.php");
        exit;
    }

    // Record the result in the database
    recordResult($result, 6-$_SESSION['livesUsed'], $_SESSION['registrationOrder']);

    // Redirect to game completed page if user successfully completes the last level
    if ($result === 'win') {
        header("Location: ../../message/game_completed.php");
        exit;
    }
    
    // Redirect back to the same level if the user hasn't completed the game yet
    header("Location: ../../levels/level6.php");
    exit;
}
?>
