-- Query to get all available books
SELECT * FROM Books WHERE available = TRUE;

-- Query to get all transactions for a specific user
SELECT * FROM Transactions 
WHERE user_id = ?;

-- Query to get all books borrowed by a user
SELECT b.title, t.transaction_type, t.transaction_date 
FROM Transactions t
JOIN Books b ON t.book_id = b.book_id
WHERE t.user_id = ?;

-- Query to get all books by a specific author
SELECT * FROM Books WHERE author = ?;

-- Query to check if a user exists by username
SELECT * FROM Users WHERE username = ?;

-- Query to check if a book exists by title
SELECT * FROM Books WHERE title = ?;
