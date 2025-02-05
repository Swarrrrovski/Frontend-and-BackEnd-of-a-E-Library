document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === 'admin' && password === 'password') {
        alert('Login successful! Redirecting to dashboard...');
        window.location.href = 'dashboard.html'; 
    } else {
        document.getElementById('error-message').textContent = 'Invalid username or password.';
        document.getElementById('error-message').style.display = 'block';
    }
});
