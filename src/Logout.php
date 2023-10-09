<?php

// Start the session if it's not already started
session_start();

// Unset all of the session variables (this could also be done with session_unset())
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect the user to the login page (or wherever you want them to go after logging out)
header('Location: login.php');
exit;

?>