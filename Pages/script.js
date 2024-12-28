// Example: Adding a new book
function addBook(event) {
    event.preventDefault();
    const title = document.getElementById("book-title").value;
    const author = document.getElementById("book-author").value;
    const genre = document.getElementById("book-genre").value;

    fetch('admin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title, author, genre })
    })
    .then(response => response.json())
    .then(data => alert(data.message || data.error))
    .catch(error => console.error('Error:', error));
}
