<?php
// session.php

// Start the session
session_start();

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
?>
