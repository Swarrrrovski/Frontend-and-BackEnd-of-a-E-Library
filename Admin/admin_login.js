document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
    
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMessage = document.getElementById("error-message");

    const credentials = {
        
        admin : { username: "admin", password: "admin123" }
    };

    

    if (username === credentials[role].username && password === credentials[role].password) {
        errorMessage.style.display = "none"; 
        alert(`Welcome, ${role}!`);
        
        
            window.location.href = "admin-dashboard.html";
        
    } else {
        errorMessage.textContent = "Invalid username or password!";
        errorMessage.style.display = "block";
    }
});
