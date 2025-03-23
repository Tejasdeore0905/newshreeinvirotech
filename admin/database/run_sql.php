<?php
require_once(__DIR__ . '/../../includes/db_config.php');

// Run site_content.sql
$site_content_sql = file_get_contents(__DIR__ . '/site_content.sql');
if ($conn->multi_query($site_content_sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo "Site content table created successfully\n";
} else {
    echo "Error creating site content table: " . $conn->error . "\n";
}

// Run gallery.sql
$gallery_sql = file_get_contents(__DIR__ . '/gallery.sql');
if ($conn->multi_query($gallery_sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo "Gallery table created successfully\n";
} else {
    echo "Error creating gallery table: " . $conn->error . "\n";
}

echo "All tables created successfully!\n";
