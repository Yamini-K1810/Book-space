// routes/book.js
const express = require('express');
const Book = require('../models/Book');
const router = express.Router();

// Add a new book
router.post('/', async (req, res) => {
  const { title, author, genre } = req.body;

  try {
    const newBook = new Book({ title, author, genre });
    await newBook.save();
    res.status(201).json(newBook);
  } catch (error) {
    res.status(500).json({ msg: 'Server error' });
  }
});

// Get all books
router.get('/', async (req, res) => {
  try {
    const books = await Book.find();
    res.json(books);
  } catch (error) {
    res.status(500).json({ msg: 'Server error' });
  }
});

// Borrow a book (update status)
router.put('/:id/borrow', async (req, res) => {
  const { id } = req.params;

  try {
    const book = await Book.findById(id);
    if (!book || book.status === 'Checked Out') {
      return res.status(400).json({ msg: 'Book not available' });
    }
    
    book.status = 'Checked Out';
    await book.save();
    res.json(book);
  } catch (error) {
    res.status(500).json({ msg: 'Server error' });
  }
});

// Return a book (update status)
router.put('/:id/return', async (req, res) => {
  const { id } = req.params;

  try {
    const book = await Book.findById(id);
    if (!book || book.status === 'Available') {
      return res.status(400).json({ msg: 'Book already available' });
    }
    
    book.status = 'Available';
    await book.save();
    res.json(book);
  } catch (error) {
    res.status(500).json({ msg: 'Server error' });
  }
});

module.exports = router;
