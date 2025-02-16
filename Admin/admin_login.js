document.getElementById("loginForm").addEventListener("submit", function(event) {
    // Clear any previous error message
    const errorMessage = document.getElementById("error-message");
    errorMessage.style.display = "none";

    const role = document.getElementById("role").value;
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!role) {
        errorMessage.textContent = "Please select a role.";
        errorMessage.style.display = "block";
        event.preventDefault(); // Prevent form submission on error
        return;
    }

    if (username === "" || password === "") {
        errorMessage.textContent = "Username and password cannot be empty.";
        errorMessage.style.display = "block";
        event.preventDefault();
    }
});
