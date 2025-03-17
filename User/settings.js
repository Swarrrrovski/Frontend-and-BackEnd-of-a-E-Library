document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("toggleDark");
    const body = document.body;

    // Function to toggle dark mode
    function updateIcon() {
        if (body.classList.contains("dark-theme")) {
            toggle.classList.remove("bi-brightness-high-fill");
            toggle.classList.add("bi-moon-fill");
        } else {
            toggle.classList.remove("bi-moon-fill");
            toggle.classList.add("bi-brightness-high-fill");
        }
    }

    // Toggle theme on click
    toggle.addEventListener("click", function () {
        body.classList.toggle("dark-theme");
        localStorage.setItem("theme", body.classList.contains("dark-theme") ? "dark" : "light");
        updateIcon();
    });

    // Apply saved theme
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        body.classList.add("dark-theme");
    }
    updateIcon();

    // Function to show a specific section
    function showSection(id) {
        // Hide all sections
        document.querySelectorAll('.settings-section').forEach(section => {
            section.classList.remove("active"); // Remove 'active' from all sections
        });

        // Show the selected section
        const sectionToShow = document.getElementById(id);
        if (sectionToShow) {
            sectionToShow.classList.add("active");
        }
    }

    // Bind section switching to the sidebar list items
    document.querySelectorAll('.sidebar li').forEach(item => {
        item.addEventListener('click', function () {
            const sectionId = this.getAttribute('data-section');
            showSection(sectionId);
        });
    });
});
