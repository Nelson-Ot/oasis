<?php
// login.php
// session_start();
require 'config.php'; // Database connection file

// Function to check rate limiting
function isRateLimited($ip_address, $conn) {
    $limit = 5; // Number of allowed attempts
    $window = 15 * 60; // Time window in seconds (15 minutes)
    
    $stmt = $conn->prepare("SELECT COUNT(*) FROM login_attempts WHERE ip_address = ? AND attempt_time > (NOW() - INTERVAL ? SECOND)");
    $stmt->bind_param("si", $ip_address, $window);
    $stmt->execute();
    $stmt->bind_result($attempt_count);
    $stmt->fetch();
    $stmt->close();

    return $attempt_count >= $limit;
}

// Function to record login attempt
function recordLoginAttempt($ip_address, $conn) {
    $stmt = $conn->prepare("INSERT INTO login_attempts (ip_address) VALUES (?)");
    $stmt->bind_param("s", $ip_address);
    $stmt->execute();
    $stmt->close();
}

// Check CSRF token
if (
    empty($_POST['csrf_token']) || 
    $_POST['csrf_token'] !== $_SESSION['csrf_token'] ||
    $_SESSION['csrf_expiry'] < time()
) {
    header("Location: home.php");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$ip_address = $_SERVER['REMOTE_ADDR']; // Get user's IP address

// Connect to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the IP address is rate-limited
if (isRateLimited($ip_address, $conn)) {
    header("Location: logout.php");
    exit();
    // die('Too many login attempts. Please try again later.');
}

// Prepare and execute SQL statement
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();
    
    // Verify password
    if (password_verify($password, $hashed_password)) {
        // Password is correct
        $_SESSION['user_id'] = $id;
        header("Location: dashboard.php");
        exit();
    } else {
        // Record failed login attempt
        recordLoginAttempt($ip_address, $conn);
        echo "Invalid username or password.";
    }
} else {
    // Record failed login attempt
    recordLoginAttempt($ip_address, $conn);
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>
