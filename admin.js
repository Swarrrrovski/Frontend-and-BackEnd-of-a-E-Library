document.getElementById('book-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const title = document.getElementById('book-title').value;
    const author = document.getElementById('book-author').value;
    const category = document.getElementById('book-category').value;
    
    const bookList = document.getElementById('book-list');
    const li = document.createElement('li');
    li.textContent = `${title} by ${author} [${category}]`;
    bookList.appendChild(li);
});
