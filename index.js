// === BACKEND SETUP ===
const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// Secret for JWT
const JWT_SECRET = "your_jwt_secret";

// MySQL Database Connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'Adrija@1234',
  database: 'library_db',
});

db.connect(err => {
  if (err) throw err;
  console.log('Connected to database');
});

// === API ROUTES ===

// User Sign-Up
app.post('/signup', async (req, res) => {
  const { username, email, password } = req.body;

  const userCheck = 'SELECT * FROM users WHERE email = ?';
  db.query(userCheck, [email], async (err, results) => {
    if (results.length > 0) {
      return res.status(400).json({ message: 'User already exists' });
    }

    const hashedPassword = await bcrypt.hash(password, 10);
    const sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?)';
    db.query(sql, [username, email, hashedPassword], (err, result) => {
      if (err) throw err;
      res.status(201).json({ message: 'User registered successfully!' });
    });
  });
});

// User Login
app.post('/login', (req, res) => {
  const { email, password } = req.body;

  const sql = 'SELECT * FROM users WHERE email = ?';
  db.query(sql, [email], async (err, results) => {
    if (results.length === 0) {
      return res.status(400).json({ message: 'User does not exist' });
    }

    const isMatch = await bcrypt.compare(password, results[0].password);
    if (!isMatch) {
      return res.status(400).json({ message: 'Invalid credentials' });
    }

    const token = jwt.sign({ id: results[0].id }, JWT_SECRET, { expiresIn: '1h' });
    res.json({ message: 'Login successful', token });
  });
});

// Fetch All Books
app.get('/books', (req, res) => {
  const sql = 'SELECT * FROM books';
  db.query(sql, (err, results) => {
    if (err) throw err;
    res.json(results);
  });
});

// Borrow Book
app.post('/borrow', (req, res) => {
  const { user_id, book_id, borrow_date } = req.body;

  const sql = 'INSERT INTO borrowings (user_id, book_id, borrow_date) VALUES (?, ?, ?)';
  db.query(sql, [user_id, book_id, borrow_date], (err, results) => {
    if (err) throw err;
    res.json({ message: 'Book borrowed successfully!' });
  });
});
