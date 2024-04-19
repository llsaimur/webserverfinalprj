<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['registrationOrder'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../../form/login.php");
    exit;
}



// Initialize session variables for a new game if not already set
if (!isset($_SESSION['currentLevel'])) {
    $_SESSION['currentLevel'] = 1;
    $_SESSION['totalLevels'] = 6; // Assuming there are 6 levels in the game
    $_SESSION['livesUsed'] = 6; // Initial number of lives for each game
    $_SESSION['registrationOrder'] = getCurrentUserRegistrationOrder(); // Get registration order of the current user
}

// Generate random numbers if not already generated
if (!isset($_SESSION['randomNumbers'])) {
    $_SESSION['randomNumbers'] = generateRandomNumbers();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user's input
    $numbers = [];
    for ($i = 1; $i <= 6; $i++) {
        $number = $_POST["number$i"];
        array_push($numbers, $number);
    }

    // Validate the user's input
    $isValid = validateNumbers($numbers);

    // Determine the outcome of the game
    if ($isValid) {
        // If user's input is valid, proceed to the next level or end the game
        if ($_SESSION['currentLevel'] < $_SESSION['totalLevels']) {
            // Redirect to the next level
            $_SESSION['currentLevel']++;
            header("Location: ../../levels/level{$_SESSION['currentLevel']}.php");
            exit;
        } 
        
    } else {
        $_SESSION['livesUsed']--;
        // If lives become zero, record game over and redirect
        if ($_SESSION['livesUsed'] == 0) {
            recordResult("Game Over", 6 - $_SESSION['livesUsed'], $_SESSION['registrationOrder']);
            header("Location: ../../levels/gameover.php");
            exit;
        }
        // User's input is invalid
        $_SESSION['error_message'] = "Invalid input! Please enter numbers in ascending order.";
        // Redirect back to the same level
        header("Location: ../../levels/level3.php");
        exit;
    }
}

// Function to retrieve the registration order of the current user
function getCurrentUserRegistrationOrder() {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kidsGames"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to retrieve registration order
    $stmt = $conn->prepare("SELECT registrationOrder FROM player WHERE userName = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($registrationOrder);
    $stmt->fetch();
    $stmt->close();

    // Close connection
    $conn->close();

    return $registrationOrder;
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

// Function to validate the user's input (example)
function validateNumbers($numbers) {
    // Implement validation logic here
    // Example: Check if the numbers are in ascending order
    for ($i = 0; $i < 5; $i++) {
        if ($numbers[$i] > $numbers[$i + 1]) {
            return false;
        }
    }
    return true;
}
?>
