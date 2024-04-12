<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['registrationOrder'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../../form/login.php");
    exit;
}

// Function to check if the user's input matches the first and last letters from the given set
function validateLetters($givenLetters, $firstLetter, $lastLetter) {
    // Sort the given letters
    $sortedLetters = str_split($givenLetters);
    sort($sortedLetters);

    // Retrieve the first and last letters from the sorted array
    $correctFirstLetter = $sortedLetters[0];
    $correctLastLetter = end($sortedLetters);

    // Check if the user's input matches the correct first and last letters
    if ($firstLetter === $correctFirstLetter && $lastLetter === $correctLastLetter) {
        return true; // User's input is correct
    } else {
        return false; // User's input is incorrect
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
    // Retrieve form data
    $smallestLetter = $_POST['smallestLetter'];
    $largestLetter = $_POST['largestLetter'];

    // Retrieve the given set of letters from the session
    $givenLetters = $_SESSION['givenLetters'];

    // Validate the user's input
    $isValid = validateLetters($givenLetters, $smallestLetter, $largestLetter);

    // Deduct a life if user's input is invalid
    if (!$isValid) {
        // Deduct a life
        $_SESSION['livesUsed']--;

        // If lives become zero, record game over and redirect
        if ($_SESSION['livesUsed'] == 0) {
            // Record "Game Over" in the database
            recordResult("Game Over", $_SESSION['livesUsed'], $_SESSION['registrationOrder']);
            // Redirect to game over page
            header("Location: ../../message/gameover.php");
            exit;
        }
    }

    // Redirect user based on validation result
    if ($isValid) {
        // Redirect to the next level or success page
        header("Location: ../../levels/level6.php");
        exit;
    } else {
         // User's input is invalid
         $_SESSION['error_message'] = "Invalid input! Please enter the largest(last) and smallest(first) letter.";
         // Redirect back to the same level
         header("Location: ../../levels/level5.php");
         exit;
    }
}
?>
