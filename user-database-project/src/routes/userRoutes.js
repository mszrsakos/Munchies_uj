const express = require('express');
const { saveUser } = require('../controllers/userController');
const router = express.Router();

router.post('/login', (req, res) => {
    const { email, password } = req.body;

    // Mentés az adatbázisba
    saveUser(email, password, (err, result) => {
        if (err) {
            return res.status(500).json({ error: 'Database error' });
        }
        res.status(200).json({ message: 'User saved successfully!' });
    });
});

module.exports = router;