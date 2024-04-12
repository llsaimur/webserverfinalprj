<?php
session_start();

// Reset session variables for a new game
unset($_SESSION['currentLevel']);
unset($_SESSION['totalLevels']);
unset($_SESSION['livesUsed']);
unset($_SESSION['registrationOrder']);

// Redirect the user to the first level of the game
header("Location: ../../form/login.php");
exit;
?>
