<?php
// Start the session
session_start();

// Check if there is an error message in the session
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

// Clear the error message from the session
unset($_SESSION['error']);



// Generate and shuffle 6 random letters
$letters = range('A', 'Z');
shuffle($letters);
$shuffledLetters = array_slice($letters, 0, 6); // Select only the first 6 shuffled letters

// Store the shuffled letters in the session for validation
$_SESSION['shuffledLetters'] = $shuffledLetters;

$livesUsed = isset($_SESSION['livesUsed']) ? $_SESSION['livesUsed'] : 6;
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
        background-image: url('https://img.freepik.com/free-vector/vector-flat-tropical-seamless-pattern-with-hand-drawn-jungle-floral-elements-animals-birds-isolated-elephant-tiger-zebra-packaging-paper-cards-wallpapers-gift-tags-nursery-decor-etc_191504-1069.jpg?size=626&ext=jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size:;
        font-family: 'Caveat Brush',cursive;
        background-color: 	#ffdcfc;
        }

        
        div {
        background-color : 	#ffdcfc;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
    }

        .center {
        margin: auto;
        width: 60%;
        border: 3px solid	#ffdcfc;
        padding: 10px;
        text-align: center;
        }


    </style>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Level 2</title>
</head>
<body>
<div class="center">
<h1>Game Level 2: Order 6 letters in descending order</h1>

<?php
// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Display the Logout link or button
    echo '<a href="../src/features/logout.php">Logout</a>&nbsp&nbsp&nbsp<a href="../src/features/logout.php">Cancel</a>';
   
}
?>

<!-- Display the letters to be sorted -->
<h2>Letters to be sorted: </h2></br>
<h3><?php echo implode(', ', $shuffledLetters); ?></h3>

<!-- Display number of lives used -->
<p>Lives left: <?php echo $livesUsed; ?></p>

<!-- Display error message if exists -->
<?php if (!empty($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="../src/functions/level2_process.php" method="post">
    <!-- Input fields for 6 letters -->
    <?php
    for ($i = 0; $i < 6; $i++) {
        $inputName = 'letter' . ($i + 1);
        echo '<label for="' . $inputName . '">Letter ' . ($i + 1) . ':</label>';
        echo '<input type="text" id="' . $inputName . '" name="' . $inputName . '" maxlength="1" >';
    }
    ?>
    
    <!-- Submit button -->
    <input type="submit" value="Submit" name="submit">

    <!-- Add try again button to reset input fields -->
    <input type="button" value="Try Again" onclick="resetInputs()">
</form>

<!-- Link to game history page -->
<p><a href="../message/game_history.php?from=level2">View Game History</a></p>

<script>
// Function to reset input fields
function resetInputs() {
    var inputs = document.querySelectorAll('input[type="text"]');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}
</script>
</div>
</body>
</html>
