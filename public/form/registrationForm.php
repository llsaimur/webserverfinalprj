<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://unpkg.com/mvp.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet"> 
<style>

        body {
        background-image: url('https://img.freepik.com/premium-vector/pattern-cat-suitable-children-s-clothing-children-s-accessories_657328-51.jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size:;
        font-family: 'Caveat Brush',cursive;
        background-color: 	#a77251;
        }

        div {
        background-color :	#a77251;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
        }


        .center {
        margin: auto;
        width: 60%;
        border: 3px solid 	#a77251;
        padding: 10px;
        text-align: center;
        }

</style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/registration_validation.js"></script> <!-- Include AJAX script -->
</head>
<body>
<div class="center">
<h1>User Registration</h1>
<form id="registrationForm" action="../src/features/register.php" method="post">
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required onkeyup="validateFirstName(this.value)"><br><br>
    <div id="firstNameError"></div>


    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required onkeyup="validateLastName(this.value)"><br><br>
    <div id="lastNameError"></div>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required onkeyup="validateUsername(this.value)"><br><br>
    <div id="usernameError"></div>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required onkeyup="validatePasswordName(this.value)"><br><br>
    <div id="passwordError"></div>

    <label for="confirmPassword">Confirm Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required onkeyup="validateconfirmPasswordName(this.value)">
    <div id="confirmPasswordError"></div>

    


    <input type="submit" value="Register" name="register">
    <button type="button" onclick="location.href='login.php';">Back</button>
    
</form>
<div id="registrationMessage"></div> <!-- Display registration messages -->
</div>
</body>
</html>
