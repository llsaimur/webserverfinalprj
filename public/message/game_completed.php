<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['registrationOrder'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../form/login.php");
    exit;
}

// Display the remaining lives
$livesLeft = isset($_SESSION['livesUsed']) ? $_SESSION['livesUsed'] : 0;

// Display a congratulations message
$message = "Congratulations! You have completed the game with $livesLeft lives remaining.";
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
        background-image: url('https://dinoanimals.com/wp-content/uploads/2018/01/Monkey-selfie-3-588x588.jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size: contain;
        font-family: 'Caveat Brush',cursive;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
        }

        div {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: auto;
        margin-top: 200px;
        width: 60%;
        border: 3px solid #b4dd35;
        padding: 10px;
        text-align: center;
        background-color: #b4dd35;
        }

        h1 {
            color: #FFFFFF;
        }

        p{
            color: #FFFFFF;
        }

        form{
        display: flex;
        align-items: center;
        justify-content: center;
        border-color: transparent;
        box-shadow: none;
        }

    </style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Completed</title>
</head>
<body>
    <div>
        <h1>Game Completed</h1>
        <p><?php echo $message; ?></p>
        <form action="../src/features/play_again.php" method="post">
            <input type="submit" value="Play Again">
        </form>
    </div>
</body>
</html>
