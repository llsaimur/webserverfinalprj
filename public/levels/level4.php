<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php">Logout</a>';
}
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
<?php
// Generate and display 6 random numbers
$numbers = [];
for ($i = 0; $i < 6; $i++) {
    $number = rand(0, 100);
    array_push($numbers, $number);
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
