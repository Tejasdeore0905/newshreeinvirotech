<?php
echo "Checking system requirements...\n\n";

// Check PHP version
echo "PHP Version: " . PHP_VERSION . "\n";
if (version_compare(PHP_VERSION, '7.4.0', '>=')) {
    echo "✓ PHP version is compatible\n";
} else {
    echo "✗ PHP 7.4.0 or higher is required\n";
}

// Check required extensions
$required_extensions = [
    'mysqli',
    'json',
    'gd',
    'fileinfo'
];

echo "\nChecking required PHP extensions:\n";
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "✓ {$ext} extension is loaded\n";
    } else {
        echo "✗ {$ext} extension is missing\n";
    }
}

// Check if directories are writable
$base_dir = __DIR__ . '/../../';
$directories = [
    $base_dir . 'uploads',
    $base_dir . 'admin/database'
];

echo "\nChecking directory permissions:\n";
foreach ($directories as $dir) {
    if (file_exists($dir)) {
        if (is_writable($dir)) {
            echo "✓ {$dir} is writable\n";
        } else {
            echo "✗ {$dir} is not writable\n";
        }
    } else {
        echo "? {$dir} does not exist\n";
    }
}

// Check MySQL connection
echo "\nChecking MySQL connection:\n";
if (class_exists('mysqli')) {
    try {
        $conn = new mysqli('localhost', 'root', 'Anirudha@123');
        if ($conn->connect_error) {
            echo "✗ Could not connect to MySQL: " . $conn->connect_error . "\n";
        } else {
            echo "✓ Successfully connected to MySQL\n";
            
            // Try to create database if it doesn't exist
            if ($conn->query("CREATE DATABASE IF NOT EXISTS shree_enviro")) {
                echo "✓ Database 'shree_enviro' is ready\n";
            } else {
                echo "✗ Could not create database: " . $conn->error . "\n";
            }
            $conn->close();
        }
    } catch (Exception $e) {
        echo "✗ MySQL Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "✗ mysqli extension is not available\n";
}

echo "\nPlease fix any issues marked with ✗ before proceeding with installation.\n";
?>
