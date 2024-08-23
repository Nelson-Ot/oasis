<?php
// logout.php
session_start();

// Destroy the session data
$_SESSION = array(); // Clear all session variables

if (ini_get("session.use_cookies")) {
    // Get session cookie parameters
    $params = session_get_cookie_params();
    
    // Delete the session cookie
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destroy the session itself
session_destroy();

// Redirect to the home or login page
header("Location: home.php");
exit();
?>
