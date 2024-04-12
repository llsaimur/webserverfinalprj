<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['registrationOrder'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php">Logout</a>';
}

// Function to generate a random set of 6 numbers
function generateRandomNumbers() {
    $numbers = range(0, 100); // Generate an array of numbers from 0 to 100
    shuffle($numbers); // Shuffle the array to randomize the order
    $randomNumbers = array_slice($numbers, 0, 6); // Select the first 6 numbers
    return $randomNumbers; // Return the array of random numbers
}

// Generate and store the random set of numbers in the session
$_SESSION['givenNumbers'] = generateRandomNumbers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://unpkg.com/mvp.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet"> 
<style>

        body {
        background-image: url('https://i.pinimg.com/originals/04/9a/59/049a590c6a9e737da387ba89d0b03e1c.png');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size:;
        font-family: 'Caveat Brush',cursive;
        background-color: #ffc0cb;
        }

        div {
        background-color :	#ffc0cb;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
        }


        .center {
        margin: auto;
        width: 60%;
        border: 3px solid #ffc0cb;
        padding: 10px;
        text-align: center;
        }

</style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Level 6</title>
</head>
<body>
<div class="center">
<h1>Game Level 6: Identify the smallest and largest number</h1>

<?php
// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php">Logout</a>&nbsp&nbsp&nbsp<a href="../src/features/logout.php">Cancel</a>';
   
}
?>

<form action="../src/functions/level6_process.php" method="post">
    <!-- Display the given set of numbers -->
    <p><?php echo implode(", ", $_SESSION['givenNumbers']); ?></p>
    
    <!-- Input fields for the user to identify the smallest and largest numbers -->
    <label for="smallestNumber">Smallest number:</label>
    <input type="number" id="smallestNumber" name="smallestNumber" >
    
    <label for="largestNumber">Largest number:</label>
    <input type="number" id="largestNumber" name="largestNumber" >

     <!-- Error message -->
     <?php
    if (isset($_SESSION['error_message'])) {
        echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']); // Clear the error message
    }
    ?>
    
    <!-- Submit button -->
    <input type="submit" value="Submit" name="submit">
</form>
<!-- Link to game history page -->
<p><a href="../message/game_history.php?from=level6">View Game History</a></p>
</div>
</body>
</html>
