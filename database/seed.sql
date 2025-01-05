-- Insert sample Users
INSERT INTO Users (username, email, password, role) VALUES
('john_doe', 'john@example.com', 'password123', 'user'),
('admin_user', 'admin@example.com', 'adminpass', 'admin');

-- Insert sample Books
INSERT INTO Books (title, author, genre, published_date) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', '1925-04-10'),
('To Kill a Mockingbird', 'Harper Lee', 'Fiction', '1960-07-11'),
('1984', 'George Orwell', 'Dystopian', '1949-06-08');

-- Insert sample Transactions
INSERT INTO Transactions (user_id, book_id, transaction_type) VALUES
(1, 1, 'borrow'),
(1, 2, 'return'),
(2, 3, 'borrow');
