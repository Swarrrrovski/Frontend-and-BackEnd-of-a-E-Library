document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("themeToggle");
    const body = document.body;
    const icon = themeToggle.querySelector("i");

    function updateIcon() {
        if (body.classList.contains("dark-mode")) {
            icon.classList.remove("bi-brightness-high-fill");
            icon.classList.add("bi-moon-fill");
            body.style.transition = '1s';
        } else {
            icon.classList.remove("bi-moon-fill");
            icon.classList.add("bi-brightness-high-fill");
            body.style.transition = '1s';
        }
    }

    themeToggle.addEventListener("click", function () {
        body.classList.toggle("dark-mode");
        localStorage.setItem("theme", body.classList.contains("dark-mode") ? "dark" : "light");
        updateIcon();
    });

    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        body.classList.add("dark-mode");
    }
    updateIcon();
});

document.getElementById('menuToggle').addEventListener('click', toggleSidebar);
document.getElementById('logoutBtn').addEventListener('click', logout);

function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
}



function logout() {
    alert("Logging out...");
    window.location.href = "ind.php";
}
