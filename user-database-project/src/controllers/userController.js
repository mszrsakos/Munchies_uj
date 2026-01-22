const db = require('../config/db');

const saveUser = (email, password, callback) => {
    const query = 'INSERT INTO users (email, password) VALUES (?, ?)';
    db.query(query, [email, password], (err, result) => {
        if (err) return callback(err);
        callback(null, result);
    });
};

module.exports = { saveUser };