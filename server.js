// server.js

// Import necessary modules
const express = require('express');
const mongoose = require('mongoose');
const dotenv = require('dotenv');
const cors = require('cors');

// Load environment variables from the .env file
// server.js

// 1. Load the dotenv configuration
require('dotenv').config();

// 2. MongoDB connection setup
const app = express();
const PORT = 5000;

// 3. Get MongoDB URI from the environment
const mongodbURI = process.env.MONGODB_URI;
console.log("MongoDB URI from .env:", mongodbURI); // Log to check if URI is loaded

if (!mongodbURI) {
    console.log("MongoDB URI is not defined in .env file");
}

// 4. MongoDB connection
mongoose.connect(mongodbURI, { useNewUrlParser: true, useUnifiedTopology: true })
    .then(() => {
        console.log('MongoDB connected');
    })
    .catch((err) => {
        console.log('MongoDB connection error:', err);
    });

// 5. Start the Express server
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
