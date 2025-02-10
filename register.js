function validateForm(event) {
    event.preventDefault(); 
    var pw1 = document.getElementById("password").value;
    var pw2 = document.getElementById("confirmPassword").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var username = document.getElementById("username").value;

    
    document.getElementById("error-message").innerHTML = "";

   
    if (fname === "" || lname === "" || username === "" || pw1 === "" || pw2 === "") {
        document.getElementById("error-message").innerHTML = "All fields are required.";
        return false;
    }

    
    if (pw1 !== pw2) {
        document.getElementById("error-message").innerHTML = "Passwords do not match.";
        return false;
    }

    
    if (pw1.length < 8) {
        document.getElementById("error-message").innerHTML = "Password must be at least 8 characters long.";
        return false;
    }

    
    localStorage.setItem("username", username);
    localStorage.setItem("password", pw1);

    
    var role = document.getElementById("selectedRoleText").innerText.split(": ")[1].toLowerCase();

    
    if (role === 'Admin') {
        document.location.href = "admin_login.html";

    } else if (role === 'User') {
        document.location.href = "user_login.html";

    } else {
        alert("Invalid role selection.");
    }
}
