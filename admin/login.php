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
    <title>Secure Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form id="loginForm" method="POST" action="login_proc.php">
        <h2>Login</h2>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
        <p id="error" style="color:red;"></p>
    </form>
    <script src="scripts.js"></script>
</body>
</html>
