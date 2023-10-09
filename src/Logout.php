<?php
session_start();

// Logout
session_destroy();

// Redirect to the login page:
header('Location: login.php');
?>