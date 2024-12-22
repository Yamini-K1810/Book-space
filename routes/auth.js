// routes/auth.js
const express = require('express');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const User = require('../models/User');
const router = express.Router();

// Register a user
router.post('/register', async (req, res) => {
  const { username, email, password } = req.body;
  
  try {
    const user = await User.findOne({ email });
    if (user) {
      return res.status(400).json({ msg: 'User already exists' });
    }
    
    const hashedPassword = await bcrypt.hash(password, 10);
    const newUser = new User({
      username,
      email,
      password: hashedPassword,
    });
    await newUser.save();
    
    const payload = { userId: newUser._id };
    const token = jwt.sign(payload, 'secret', { expiresIn: '1h' });
    res.status(201).json({ token });
    
  } catch (error) {
    res.status(500).json({ msg: 'Server error' });
  }
});

// Login a user
router.post('/login', async (req, res) => {
  const { email, password } = req.body;
  
  try {
    const user = await User.findOne({ email });
    if (!user) {
      return res.status(400).json({ msg: 'Invalid credentials' });
    }
    
    const isMatch = await bcrypt.compare(password, user.password);
    if (!isMatch) {
      return res.status(400).json({ msg: 'Invalid credentials' });
    }
    
    const payload = { userId: user._id };
    const token = jwt.sign(payload, 'secret', { expiresIn: '1h' });
    res.json({ token });
    
  } catch (error) {
    res.status(500).json({ msg: 'Server error' });
  }
});

module.exports = router;
