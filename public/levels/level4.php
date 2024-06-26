<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php">Logout</a>';
}

$livesUsed = isset($_SESSION['livesUsed']) ? $_SESSION['livesUsed'] : 6;

// Function to generate random numbers and store them in the session
function generateRandomNumbers() {
    $randomNumbers = [];
    for ($i = 0; $i < 6; $i++) {
        $number = rand(0, 100);
        array_push($randomNumbers, $number);
    }
    $_SESSION['randomNumbers'] = $randomNumbers;
}

// Generate and store random numbers in the session if not already generated
generateRandomNumbers();
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
        background-image: url('https://thumbs.dreamstime.com/b/doodle-various-animal-collection-illustration-99722872.jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size:;
        font-family: 'Caveat Brush',cursive;
        background-color: 	#fcff88;
        }

        div {
        background-color :	#fcff88;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
    }


        .center {
        margin: auto;
        width: 60%;
        border: 3px solid #fcff88;
        padding: 10px;
        text-align: center;
        }

</style>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Level 4</title>
</head>
<body>
<div class="center">
<h1>Game Level 4: Order 6 numbers in Descending order</h1>

<?php
// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php">Logout</a>&nbsp&nbsp&nbsp<a href="../src/features/logout.php">Cancel</a>';
   
}
?>

<!-- Display the 6 random numbers -->
<h2>Numbers:</h2>
<!-- Display number of lives used -->
<p>Lives left: <?php echo $livesUsed; ?></p>
        
        <?php
        // Display random numbers from the session
        foreach ($_SESSION['randomNumbers'] as $number) {
            echo $number . ' ';
        }
        ?>

<form action="../src/functions/level4_process.php" method="post">
    <!-- Input fields for 6 numbers -->
    <?php
    // Display input fields for the 6 numbers
    for ($i = 0; $i < 6; $i++) {
        echo '<label for="number' . ($i + 1) . '">Number ' . ($i + 1) . ':</label>';
        echo '<input type="text" id="number' . ($i + 1) . '" name="number' . ($i + 1) . '" ><br>';
    }
    ?>

    <!-- Display number of lives used -->
<p>Lives used: <?php echo $livesUsed; ?></p>

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
<p><a href="../message/game_history.php?from=level4">View Game History</a></p>
</div>
</body>
</html>
