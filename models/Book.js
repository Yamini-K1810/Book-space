// models/Book.js
const mongoose = require('mongoose');

const BookSchema = new mongoose.Schema({
  title: { type: String, required: true },
  author: { type: String, required: true },
  genre: { type: String, required: true },
  status: { type: String, default: 'Available' }, // Available, Checked Out
});

module.exports = mongoose.model('Book', BookSchema);
