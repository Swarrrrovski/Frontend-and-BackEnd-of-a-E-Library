document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMessage = document.getElementById("error-message");

    const credentials = {
        user: { username: "user", password: "user123" }
    };

    // No need to use 'role' if you're just checking the 'user' credentials
    if (username === credentials.user.username && password === credentials.user.password) {
        errorMessage.style.display = "none"; 
        alert("Welcome, user!");
        
        // Redirect to user dashboard after successful login
        window.location.href = "user-dashboard.php";
    } else {
        errorMessage.textContent = "Invalid username or password!";
        errorMessage.style.display = "block";
    }
});
