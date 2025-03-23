<?php
require_once('../includes/db_config.php');

// Create admin_users table
$sql = "CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    status ENUM('active', 'inactive') DEFAULT 'active'
)";

if ($conn->query($sql) === TRUE) {
    echo "admin_users table created successfully<br>";
} else {
    echo "Error creating admin_users table: " . $conn->error . "<br>";
}

// Create events table
$sql = "CREATE TABLE IF NOT EXISTS events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    description TEXT NOT NULL,
    images TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "events table created successfully<br>";
} else {
    echo "Error creating events table: " . $conn->error . "<br>";
}

// Create clients table
$sql = "CREATE TABLE IF NOT EXISTS clients (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(255),
    description TEXT,
    website VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "clients table created successfully<br>";
} else {
    echo "Error creating clients table: " . $conn->error . "<br>";
}

// Create projects table
$sql = "CREATE TABLE IF NOT EXISTS projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(100) NOT NULL,
    status ENUM('completed', 'ongoing', 'planned') DEFAULT 'ongoing',
    images TEXT,
    client_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE SET NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "projects table created successfully<br>";
} else {
    echo "Error creating projects table: " . $conn->error . "<br>";
}

// Create services table
$sql = "CREATE TABLE IF NOT EXISTS services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(50),
    image VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "services table created successfully<br>";
} else {
    echo "Error creating services table: " . $conn->error . "<br>";
}

// Create contact_submissions table
$sql = "CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "contact_submissions table created successfully<br>";
} else {
    echo "Error creating contact_submissions table: " . $conn->error . "<br>";
}

// Create admin_activity_log table
$sql = "CREATE TABLE IF NOT EXISTS admin_activity_log (
    id INT PRIMARY KEY AUTO_INCREMENT,
    admin_id INT NOT NULL,
    activity TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "admin_activity_log table created successfully<br>";
} else {
    echo "Error creating admin_activity_log table: " . $conn->error . "<br>";
}

// Create default admin user
$default_username = "admin";
$default_password = password_hash("admin123", PASSWORD_DEFAULT);
$default_email = "admin@example.com";
$default_name = "Administrator";

$sql = "INSERT INTO admin_users (username, password, email, full_name) 
        VALUES (?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE id=id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $default_username, $default_password, $default_email, $default_name);

if ($stmt->execute()) {
    echo "Default admin user created successfully<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
} else {
    echo "Error creating default admin user: " . $stmt->error . "<br>";
}

$stmt->close();
$conn->close();

echo "<br>Database setup completed. You can now log in with the default credentials.";
?> 