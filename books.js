
document.addEventListener("DOMContentLoaded", function() {
    fetch("/api/getBooks") // Adjust API endpoint as needed
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById("books-container");
            container.innerHTML = "";
            data.forEach(book => {
                const bookItem = document.createElement("div");
                bookItem.classList.add("book-item");
                bookItem.innerHTML = `
                    <h3>${book.title}</h3>
                    <p>Author: ${book.author}</p>
                    <p>Available Copies: ${book.availableCopies}</p>
                `;
                container.appendChild(bookItem);
            });
        })
        .catch(error => console.error("Error fetching books:", error));
});