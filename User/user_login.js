document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
    
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMessage = document.getElementById("error-message");

    const credentials = {
        
        user: { username: "user", password: "user123" }
    };

    

    if (username === credentials[role].username && password === credentials[role].password) {
        errorMessage.style.display = "none"; 
        alert(`Welcome, ${role}!`);
        
        
            window.location.href = "user-dashboard.html";
        
    } else {
        errorMessage.textContent = "Invalid username or password!";
        errorMessage.style.display = "block";
    }
});
