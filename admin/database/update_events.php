<?php
require_once(__DIR__ . '/../../includes/db_config.php');

// Run events.sql
$events_sql = file_get_contents(__DIR__ . '/events.sql');
if ($conn->multi_query($events_sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo "Events table updated successfully\n";
} else {
    echo "Error updating events table: " . $conn->error . "\n";
}
