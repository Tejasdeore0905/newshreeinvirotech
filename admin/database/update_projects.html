<?php
require_once(__DIR__ . '/../../includes/db_config.php');

// Run projects.sql
$projects_sql = file_get_contents(__DIR__ . '/projects.sql');
if ($conn->multi_query($projects_sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo "Projects table updated successfully\n";
} else {
    echo "Error updating projects table: " . $conn->error . "\n";
}
