function selectRole(role) {
    // Update the displayed role text
    document.getElementById('selectedRoleText').textContent = 'Selected Role: ' + role;

    // Show the registration form container
    document.getElementById('registrationContainer').style.display = 'block';

    // Save the selected role in a hidden input field
    const roleInput = document.createElement('input');
    roleInput.type = 'hidden';
    roleInput.name = 'role';
    roleInput.value = role;

    // Append the hidden role input to the form
    document.getElementById('registrationForm').appendChild(roleInput);
}

document.getElementById('registrationForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    // Form field validation logic
    var pw1 = document.getElementById("password").value;
    var pw2 = document.getElementById("confirmPassword").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var username = document.getElementById("username").value;

    document.getElementById("error-message").innerHTML = "";

    if (fname === "" || lname === "" || username === "" || pw1 === "" || pw2 === "") {
        document.getElementById("error-message").innerHTML = "All fields are required.";
        return;
    }

    if (pw1 !== pw2) {
        document.getElementById("error-message").innerHTML = "Passwords do not match.";
        return;
    }

    if (pw1.length < 8) {
        document.getElementById("error-message").innerHTML = "Password must be at least 8 characters long.";
        return;
    }

    // Prepare form data
    const formData = new FormData(this);

    // Send form data via AJAX request using fetch
    try {
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.text(); // Get response from PHP file

        if (response.ok) {
            alert('Registration successful');
            // Redirect to ind.php page using JavaScript
            window.location.href = '../libraryphp/ind.php';
        } else {
            document.getElementById('error-message').innerHTML = result;
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('error-message').innerHTML = 'Registration failed. Please try again.';
    }
});
