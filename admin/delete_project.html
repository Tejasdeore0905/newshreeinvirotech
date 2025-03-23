<?php
session_start();
require_once('../includes/db_config.php');

header('Content-Type: application/json');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Project ID not provided']);
    exit;
}

$project_id = intval($_GET['id']);

// Get project details for logging and image deletion
$stmt = $conn->prepare("SELECT title, image_path FROM projects WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

if (!$project) {
    echo json_encode(['success' => false, 'message' => 'Project not found']);
    exit;
}

// Delete the project
$delete_stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
$delete_stmt->bind_param("i", $project_id);

if ($delete_stmt->execute()) {
    // Delete the project image if it exists
    if (!empty($project['image_path']) && file_exists($project['image_path'])) {
        unlink($project['image_path']);
    }

    // Log the activity
    $activity = "Deleted project: " . $project['title'];
    $admin_id = $_SESSION['admin_id'];
    $log_stmt = $conn->prepare("INSERT INTO admin_activity_log (admin_id, activity) VALUES (?, ?)");
    $log_stmt->bind_param("is", $admin_id, $activity);
    $log_stmt->execute();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting project']);
}
?>
