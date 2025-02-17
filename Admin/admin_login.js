document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMessage = document.getElementById("error-message");

    const credentials = {
        admin: { username: "admin", password: "admin123" }
    };

    // No need to use 'role' if you're just checking the 'user' credentials
    if (username === credentials.admin.username && password === credentials.admin.password) {
        errorMessage.style.display = "none"; 
        alert("Welcome, admin!");
        
        // Redirect to user dashboard after successful login
        window.location.href = "admin-dashboard.html";
    } else {
        errorMessage.textContent = "Invalid username or password!";
        errorMessage.style.display = "block";
    }
});
