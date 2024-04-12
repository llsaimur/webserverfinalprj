<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://unpkg.com/mvp.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet"> 
<style>

        body {
        background-image: url('https://static.vecteezy.com/system/resources/previews/008/412/604/original/zoo-animals-group-in-flat-cartoon-style-free-vector.jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size: 100%;
        font-family: 'Caveat Brush',cursive;
        background-color: #ffffff;
        }

        div {
        background-color :	#ffffff;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
        }


        .center {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: auto;
        margin-top: 40px;
        width: 45%;
        border: 3px solid #007cff;
        padding: 10px;
        text-align: center;
        }

        .form1{
        display: flex;
        align-items: center;
        justify-content: center;
        }

</style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>
</head>
<body>
<div class="center">
<h2>User Login</h2>
<form action="../src/features/login_process.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php endif; ?>

    <form class="form1">
    <input type="submit" value="Login" name="login">
    <!-- Button to change password -->
    <button type="button" onclick="location.href='forgot_password.php';">Forgot your password? Change it.</button>
    
    <!-- Add a button for user registration -->
    <button type="button" onclick="location.href='registrationForm.php';">Register</button>
    </form>
</form>
</div>
</body>
</html>
