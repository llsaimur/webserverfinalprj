<?php
session_start();
//href="https://unpkg.com/mvp.css"
/*            
        display: flex;
        justify-content: center;
        align-items: center;\
*/ 
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
        background-image: url('https://i.pinimg.com/originals/c6/2e/4c/c62e4ce5d1f2c29c6f7380fbaade810f.jpg');
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

        form {

        margin: auto;
        margin-top: 200px;
        width: 60%;
        border: 3px solid #fe7f9c;
        padding: 10px;
        text-align: center;
        background-color: #fe7f9c;
        }

        h1 {
            color: #FFFFFF;
        }

        p{
            color: #FFFFFF;
        }

    </style>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Over</title>
</head>
<body>
<form>
<h1>Game Over</h1>
<p>Sorry, you have exhausted all your lives. Better luck next time!</p>
<a href="../src/features/play_again.php">Play Again</a>
</form>
</body>
</html>
