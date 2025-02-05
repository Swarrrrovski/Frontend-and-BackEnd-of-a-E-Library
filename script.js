// Load books from books.json
let books = [];

fetch('data/books.json')
  .then(response => response.json())
  .then(data => {
    books = data;
    renderBooks();
  });

// Render books
function renderBooks(filteredBooks = books) {
  const bookList = document.getElementById('book-list');
  bookList.innerHTML = '';
  filteredBooks.forEach(book => {
    const bookItem = document.createElement('div');
    bookItem.className = 'book-item';
    bookItem.innerHTML = `
      <h3>${book.title}</h3>
      <p>Author: ${book.author}</p>
      <p>Category: ${book.category}</p>
      <p>Status: ${book.available ? 'Available' : 'Borrowed'}</p>
    `;
    bookList.appendChild(bookItem);
  });
}

// Search functionality
const searchInput = document.getElementById('search');
if (searchInput) {
  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    const filteredBooks = books.filter(book =>
      book.title.toLowerCase().includes(query) ||
      book.author.toLowerCase().includes(query) ||
      book.category.toLowerCase().includes(query)
    );
    renderBooks(filteredBooks);
  });
}

// Add book functionality (Admin)
const addBookForm = document.getElementById('add-book-form');
if (addBookForm) {
  addBookForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const title = document.getElementById('title').value;
    const author = document.getElementById('author').value;
    const category = document.getElementById('category').value;
    const newBook = {
      id: books.length + 1,
      title,
      author,
      category,
      available: true
    };
    books.push(newBook);
    renderBooks();
    addBookForm.reset();
  });
}

fetch('data/books.json')
    .then(response => response.json())
    .then(books => {
        const bookList = document.getElementById('book-list');
        books.forEach(book => {
            const li = document.createElement('li');
            li.textContent = `${book.title} by ${book.author} [${book.category}] - ${book.available ? "Available" : "Borrowed"}`;
            bookList.appendChild(li);
        });
    });

document.getElementById('search').addEventListener('input', function(event) {
    const query = event.target.value.toLowerCase();
    const books = document.querySelectorAll('#book-list li');
    books.forEach(book => {
        book.style.display = book.textContent.toLowerCase().includes(query) ? 'block' : 'none';
    });
});