<?php
require_once(__DIR__ . '/../../includes/db_config.php');

// Function to run SQL file
function runSQLFile($conn, $filename) {
    echo "Running $filename...\n";
    $sql = file_get_contents($filename);
    
    // Split into individual queries
    $queries = array_filter(array_map('trim', explode(';', $sql)));
    
    $success = true;
    foreach ($queries as $query) {
        if (!empty($query) && !preg_match('/^--/', $query)) {  // Skip comments
            if ($conn->query($query)) {
                echo "Success: " . substr($query, 0, 50) . "...\n";
            } else {
                echo "Error: " . $conn->error . "\n";
                $success = false;
            }
        }
    }
    return $success;
}

// Create required directories
$base_dir = __DIR__ . '/../../';
$directories = [
    $base_dir . 'uploads/',
    $base_dir . 'uploads/projects/',
    $base_dir . 'uploads/clients/',
    $base_dir . 'uploads/events/',
    $base_dir . 'uploads/services/'
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        if (mkdir($dir, 0777, true)) {
            echo "Created directory: $dir\n";
        } else {
            echo "Error creating directory: $dir\n";
        }
    } else {
        echo "Directory already exists: $dir\n";
    }
}

// Run structure.sql
if (runSQLFile($conn, __DIR__ . '/structure.sql')) {
    echo "Database structure created successfully\n";
} else {
    echo "Error creating database structure\n";
    exit;
}

// Run sample_data.sql
if (runSQLFile($conn, __DIR__ . '/sample_data.sql')) {
    echo "Sample data inserted successfully\n";
} else {
    echo "Error inserting sample data\n";
}

echo "\nInstallation completed. You can now use the admin dashboard.";
?>
