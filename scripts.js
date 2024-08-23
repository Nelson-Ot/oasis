// scripts.js
document.getElementById('registrationForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const errorElem = document.getElementById('error');
    
    if (password !== confirmPassword) {
        errorElem.textContent = 'Passwords do not match.';
        event.preventDefault();
        return;
    }
    
    // Add more validations as needed
});

// scripts.js
document.getElementById('loginForm').addEventListener('submit', function(event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorElem = document.getElementById('error');
    
    // Basic validation
    if (username.length < 3 || password.length < 6) {
        errorElem.textContent = 'Username must be at least 3 characters and password must be at least 6 characters.';
        event.preventDefault(); // Prevent form submission
    }
});
