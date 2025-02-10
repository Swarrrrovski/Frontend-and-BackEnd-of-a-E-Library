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

const borrowedBooks = [
    { title: "Harry Potter", author: "J.K. Rowling" },
    { title: "The Great Gatsby", author: "F. Scott Fitzgerald" }
];

const bookList = document.getElementById('bookList');
borrowedBooks.forEach(book => {
    const li = document.createElement('li');
    li.textContent = book.title + " by " + book.author; // Use string concatenation here
    bookList.appendChild(li);
});

const purchasedBooks = [
    { title: "To Kill a Mockingbird", author: "Harper Lee" },
    { title: "The Hobbit", author: "J.R.R. Tolkien" }
];

const purchasedList = document.getElementById('purchasedList');
purchasedBooks.forEach(book => {
    const li = document.createElement('li');
    li.textContent = book.title + " by " + book.author; // Use string concatenation here
    purchasedList.appendChild(li);
});

const duePayments = [
    { amount: "$10", dueDate: "Feb 10, 2025" },
    { amount: "$15", dueDate: "Mar 1, 2025" }
];

const duePaymentsList = document.getElementById('duePayments');
duePayments.forEach(payment => {
    const li = document.createElement('li');
    li.textContent = "Amount: " + payment.amount + ", Due Date: " + payment.dueDate; // Use string concatenation here
    duePaymentsList.appendChild(li);
});

const subscriptionExpiry = "March 15, 2025";
document.getElementById('subscriptionStatus').textContent = "Your subscription expires on: " + subscriptionExpiry; // Use string concatenation here

function logout() {
    alert("Logging out...");
    window.location.href = "user_login.html";
}
