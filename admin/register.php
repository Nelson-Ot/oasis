<?php
// register.php
// session_start();
require 'config.php'; // Database connection

// Validate CSRF token
if (
    empty($_POST['csrf_token']) || 
    $_POST['csrf_token'] !== $_SESSION['csrf_token'] ||
    $_SESSION['csrf_expiry'] < time()
) {
    // Redirect to home.php if CSRF token is invalid or expired
    header("Location: home.php");
    exit();
}

// Sanitize and validate user input
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Additional server-side validation
if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    die('Please fill in all fields.');
}
if ($password !== $confirm_password) {
    die('Passwords do not match.');
}

// Connect to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the username or email is already taken
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die('Username or email already taken.');
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert the new user into the database
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);
$stmt->execute();

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect to login page
header("Location: login.php");
exit();
?>
