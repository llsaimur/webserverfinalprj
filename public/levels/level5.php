<?php
// Function to generate a random set of 6 letters
function generateRandomLetters() {
    $letters = range('A', 'Z'); // Generate an array of uppercase letters from A to Z
    shuffle($letters); // Shuffle the array to randomize the order
    $randomLetters = array_slice($letters, 0, 6); // Select the first 6 letters
    return implode("", $randomLetters); // Convert the array to a string
}

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php"><h2>Logout</h2></a>';
}

session_start();
// Generate and store the random set of letters in the session
$_SESSION['givenLetters'] = generateRandomLetters();
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
        background-image: url('https://www.robertkaufman.com/assets/fabric/detail/AAK-21496-48.jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size:;
        font-family: 'Caveat Brush',cursive;
        background-color: #70ca82;
        }

        div {
        background-color : #70ca82;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
    }


        .center {
        margin: auto;
        width: 60%;
        border: 3px solid #70ca82;
        padding: 10px;
        text-align: center;
        }

</style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Level 5</title>
</head>
<body>
<div class="center">
<h1>Game Level 5: Identify the first and last letter</h1>

<?php
// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php">Logout</a>&nbsp&nbsp&nbsp<a href="../src/features/logout.php">Cancel</a>';
   
}
?>

<form action="../src/functions/level5_process.php" method="post">
    <!-- Display the given set of letters -->
    <p><?php echo $_SESSION['givenLetters']; ?></p>
    
    <!-- Input fields for the user to identify the first and last letters -->
    <label for="smallestLetter">First (smallest) letter:</label>
    <input type="text" id="smallestLetter" name="smallestLetter" maxlength="1" >
    
    <label for="largestLetter">Last (largest) letter:</label>
    <input type="text" id="largestLetter" name="largestLetter" maxlength="1" >

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
<p><a href="../message/game_history.php?from=level5">View Game History</a></p>
</br>
</br>
</br>
</div>
</body>
</html>
