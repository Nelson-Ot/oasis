<?php 
session_start();

// Generate CSRF token if not set or if expired
if (empty($_SESSION['csrf_token']) || $_SESSION['csrf_expiry'] < time()) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_expiry'] = time() + 900; // 15 minutes in seconds
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form id="registrationForm" method="POST" action="register.php">
        <h2>Register</h2>
        
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" pattern="[a-zA-Z0-9]{3,30}" title="3-30 characters, alphanumeric only" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" pattern=".{8,}" title="8 characters minimum" required>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        
        <button type="submit">Register</button>
        <p id="error" style="color:red;"></p>
    </form>
    <script src="scripts.js"></script>
</body>
</html>
