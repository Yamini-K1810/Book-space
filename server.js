<<<<<<< HEAD
// Import required packages
require('dotenv').config();  // This will load variables from the .env file
const express = require('express');
const mongoose = require('mongoose');

// Initialize Express app
const app = express();

// Use middleware to parse incoming JSON requests
app.use(express.json());

// Set up MongoDB connection using Mongoose
const dbURI = process.env.MONGODB_URI;
if (!dbURI) {
    console.error('MongoDB URI is not defined in .env file');
    process.exit(1);  // Exit the app if URI is not found
}

mongoose.connect(dbURI, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
})
    .then(() => console.log('MongoDB connected'))
    .catch((err) => {
        console.error('MongoDB connection error:', err);
        process.exit(1);  // Exit if connection fails
    });

// Define a simple route for testing
app.get('/', (req, res) => {
    res.send('Hello, World!');
});

// Define a basic example route for Books
app.get('/books', (req, res) => {
    res.json({ message: 'Here are your books.' });
});

// Set the server to listen on port 5000
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
=======
// server.js
const express = require('express');
const connectDB = require('./config/db');
const bodyParser = require('body-parser');
const authRoutes = require('./routes/auth');
const bookRoutes = require('./routes/book');
const authMiddleware = require('./middleware/authMiddleware');

const app = express();

// Connect to DB
connectDB();

// Middleware
app.use(bodyParser.json());

// Routes
app.use('/api/auth', authRoutes);
app.use('/api/books', authMiddleware, bookRoutes);

app.listen(5000, () => {
  console.log('Server is running on port 5000');
>>>>>>> 4ec023bed1fd39f410a7e389df7316f603c3e6c9
});
