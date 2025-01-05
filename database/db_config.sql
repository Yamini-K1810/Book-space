const mysql = require('mysql2');

// Create a connection pool to manage database connections
const pool = mysql.createPool({
  host: 'localhost', // Database host (can be an IP or a hostname)
  user: 'root',      // MySQL username (adjust as needed)
  password: '',      // MySQL password (provide your password here)
  database: 'bookstore', // Database name
  waitForConnections: true,
  connectionLimit: 10,  // Number of connections to allow at once
  queueLimit: 0
});

// Promisify the pool.query method to use async/await
const promisePool = pool.promise();

module.exports = promisePool;
