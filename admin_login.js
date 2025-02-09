document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
    const role = document.getElementById("role").value;
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMessage = document.getElementById("error-message");

    const credentials = {
        
        admin: { username: "admin", password: "admin123" }
    };

    if (!role) {
        errorMessage.textContent = "Please select a role.";
        errorMessage.style.display = "block";
        return;
    }

    if (username === credentials[role].username && password === credentials[role].password) {
        errorMessage.style.display = "none"; 
        alert(`Welcome, ${role}!`);
        
        if (role === "admin") {
            window.location.href = "admin-dashboard.html";
        }
    } else {
        errorMessage.textContent = "Invalid username or password!";
        errorMessage.style.display = "block";
    }
});
