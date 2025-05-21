<?php
session_start(); // Start the session

// Destroy all session data to log the user out
session_destroy();

// Redirect the user back to the login page
header('Location: login.php');
exit();
?>
