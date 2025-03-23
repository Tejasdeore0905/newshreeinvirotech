<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Anirudha@123');
define('DB_NAME', 'shree_enviro');

// Email configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'anirudhaviit@gmail.com'); // Replace with your Gmail address
define('SMTP_PASS', 'Anirudha@22420299'); // Replace with your Gmail app password
define('SMTP_FROM', 'anirudhaviit@gmail.com'); // Replace with your Gmail address
define('SMTP_FROM_NAME', 'Shree Enviro Tech');

// Create database connection
try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?> 