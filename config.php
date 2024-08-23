<?php
// config.php

session_start();

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'oasis_db');

// Generate CSRF token if not set or if expired
if (empty($_SESSION['csrf_token']) || $_SESSION['csrf_expiry'] < time()) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_expiry'] = time() + 900; // 15 minutes in seconds
}
?>
