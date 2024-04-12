<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 900) { // 900 seconds = 15 minutes
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the home page
    header("Location: ../../../index.php");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
