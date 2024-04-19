<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Messages</title>
    <link rel="stylesheet"  href="https://unpkg.com/mvp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet"> 
    <style>
        body {
            background-image: url('https://thumbs.dreamstime.com/b/childish-animals-seamless-pattern-cute-summer-wild-fauna-background-kids-jungle-wildlife-cartoon-safari-zoo-tropical-nursery-215880786.jpg');
            background-repeat: repeat;
            background-attachment: fixed;
            font-family: 'Caveat Brush',cursive;
        }
        
        .error-container {
            margin: 20px;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c2c7; 
            color: #842029; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        }

        .error-message {
            font-size: 16px;
            line-height: 1.5; 
        }
    </style>
</head>
<body>
<?php
// Establish database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidsgames";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Perform server-side validation
$errors = array();

if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirmPassword)) {
    $errors[] = "All fields are required.";
}

if (!ctype_alpha($firstName[0]) || !ctype_alpha($lastName[0]) || !ctype_alpha($username[0])) {
    $errors[] = "First Name, Last Name, and Username must start with a letter.";
}

if (strlen($username) < 8 || strlen($password) < 8) {
    $errors[] = "Username and Password must be at least 8 characters long.";
}

if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
}

// Check if username already exists
$sql = "SELECT * FROM player WHERE userName='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $errors[] = "Username already exists.";
}

// If no errors, insert data into database
if (empty($errors)) {
    // Insert user into player table
    $sql = "INSERT INTO player (fName, lName, userName, registrationTime) VALUES ('$firstName', '$lastName', '$username', now())";
    if ($conn->query($sql) === TRUE) {
        // Insert password into authenticator table
        $passCode = password_hash($password, PASSWORD_DEFAULT);
        $registrationOrder = $conn->insert_id; // Get the auto-generated registrationOrder
        $sql = "INSERT INTO authenticator (passCode, registrationOrder) VALUES ('$passCode', '$registrationOrder')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful! Redirecting to home page...";
            header("refresh:3;url=../../form/login.php"); // Redirect to home page after 3 seconds
            exit();
        } else {
            echo "Error inserting password: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error inserting user: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo '<div style="text-align: center; font-size: 24px; color: #ff0000; border: 6px solid #ff0000;">';
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    echo "</div>";
    
    echo "<meta http-equiv='refresh' content='3;url=../../form/registrationForm.php'>";
    echo '<script>alert("Registration unsuccessful, the page will refresh automatically in 3 seconds. Try again!");</script>';
    

}
$conn->close();
?>
</body>
</html>