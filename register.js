function selectRole(role) {
    document.querySelector('.role-selection').style.display = 'none';
    document.querySelector('.registration-container').style.display = 'block';
    document.getElementById('selectedRoleText').innerText = "Registering as: " + role.toUpperCase();
}

function validateForm(event) {
    event.preventDefault(); 

    var pw1 = document.getElementById("password").value;
    var pw2 = document.getElementById("confirmPassword").value;
    var name1 = document.getElementById("fname").value;
    var name2 = document.getElementById("lname").value;
    var username = document.getElementById("username").value;

    document.getElementById("blankMsg").innerHTML = "";
    document.getElementById("charMsg").innerHTML = "";
    document.getElementById("message1").innerHTML = "";
    document.getElementById("message2").innerHTML = "";

    if (name1 === "") {
        document.getElementById("blankMsg").innerHTML = "**Fill the first name";
        return false;
    }

    if (!isNaN(name1)) {
        document.getElementById("blankMsg").innerHTML = "**Only characters are allowed";
        return false;
    }

    if (!isNaN(name2)) {
        document.getElementById("charMsg").innerHTML = "**Only characters are allowed";
        return false;
    }

    if (pw1 === "") {
        document.getElementById("message1").innerHTML = "**Fill the password please!";
        return false;
    }

    if (pw2 === "") {
        document.getElementById("message2").innerHTML = "**Enter the password please!";
        return false;
    }

    if (pw1.length < 8) {
        document.getElementById("message1").innerHTML = "**Password length must be at least 8 characters";
        return false;
    }

    if (pw1.length > 15) {
        document.getElementById("message1").innerHTML = "**Password length must not exceed 15 characters";
        return false;
    }

    if (pw1 !== pw2) {
        document.getElementById("message2").innerHTML = "**Passwords are not the same";
        return false;
    }

    localStorage.setItem("username", username);
    localStorage.setItem("password", pw1);

    alert("Registration successful!");

    
    window.location.href = "user_login.html";
    return true;
}
window.location.href = "user_login.html";

document.getElementById('registrationForm').addEventListener('submit', validateForm);
