<?php
session_start();

function logout() {
    $_SESSION = array();
    // If the session ID is set via cookie, set it to an expired time
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    session_destroy();
    header("Location: login-form.php");
    exit;
}

// Check if the user is already logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Check if the last activity time exceeds 1 hour
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
        logout();
    } else {
        // Update the last activity time
        $_SESSION['last_activity'] = time();
    }
} else {
    // Check if there is a manual logout request
    if(isset($_GET['logout'])) {
        logout();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <h2>Logout</h2>
    <p>Are you sure you want to logout?</p>
    <a href="?logout=true">Logout</a>
</body>
</html>
