<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    //$firstName = $_POST['firstName'];
   // $lastName = $_POST['lastName'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Validate form data (e.g., check if fields are not empty, confirm password match, etc.)

    // If the form is submitted with the "Edit" button
    if (isset($_POST['edit'])) {
        // Process password change
        // (e.g., update the password in the database for the user with the given username)
        // Assuming you have a function to update the password in the database
        if (updatePassword($username, $newPassword)) {
            // Password updated successfully
             // Redirect to the password changed success page
             header("Location: password_changed.php");
             exit;
        } else {
            // Failed to update password
             // Error changing password
             $errorMessage = "Error changing password. Please try again.";
        }
    }
     // If the form is submitted with the "Cancel" button
     elseif (isset($_POST['cancel'])) {
        // Redirect to the login page
        header("Location: ../../form/login.php");
        exit;
    }
}

// Function to update password in the database
function updatePassword($username, $newPassword) {
    // Connect to your database
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "kidsGames";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to update password in authenticator table
    $stmt = $conn->prepare("UPDATE authenticator SET passCode = ? WHERE registrationOrder = (SELECT registrationOrder FROM player WHERE userName = ?)");
    
    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Bind parameters
    $stmt->bind_param("ss", $hashedPassword, $username);

    // Execute the statement
    $result = $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Return true if the update was successful, false otherwise
    return $result;
}


?>
