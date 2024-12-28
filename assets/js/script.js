// Function to handle borrowing a book via AJAX
function borrowBook(bookId) {
    var button = document.getElementById('borrowButton' + bookId);

    // Disable the button to prevent multiple clicks
    button.disabled = true;
    button.innerHTML = 'Borrowing...';

    // Create AJAX request to borrow the book
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "borrow_book.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status == 200) {
            alert(xhr.responseText); // Show success or error message
            button.innerHTML = 'Borrowed';
            button.disabled = true; // Disable button after borrowing
        } else {
            alert("An error occurred while borrowing the book.");
            button.disabled = false;
            button.innerHTML = 'Try Again';
        }
    };

    xhr.send("book_id=" + bookId);
}
