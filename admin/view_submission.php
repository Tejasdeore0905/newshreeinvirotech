<?php
session_start();
require_once('../includes/db_config.php');

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = (int)$_GET['id'];
$query = "SELECT * FROM contact_submissions WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0) {
    header("Location: dashboard.php");
    exit();
}

$submission = $result->fetch_assoc();

// Update status to 'read' if it's 'new'
if($submission['status'] === 'new') {
    $update_query = "UPDATE contact_submissions SET status = 'read' WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("i", $id);
    $update_stmt->execute();
    $submission['status'] = 'read';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Submission - Shree Enviro Tech</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="../assets/logo.png" alt="Shree Enviro Tech Logo" class="admin-logo">
                <h3>Admin Panel</h3>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="active"><a href="#"><i class="fas fa-envelope"></i> View Submission</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-bar">
                <h2>View Submission</h2>
                <div class="user-info">
                    <a href="dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                </div>
            </div>

            <div class="submission-details">
                <div class="detail-card">
                    <div class="detail-header">
                        <h3>Submission Details</h3>
                        <span class="status <?php echo $submission['status']; ?>"><?php echo ucfirst($submission['status']); ?></span>
                    </div>
                    <div class="detail-body">
                        <div class="detail-row">
                            <label>Date:</label>
                            <span><?php echo date('d M Y H:i', strtotime($submission['submission_date'])); ?></span>
                        </div>
                        <div class="detail-row">
                            <label>Name:</label>
                            <span><?php echo htmlspecialchars($submission['name']); ?></span>
                        </div>
                        <div class="detail-row">
                            <label>Company:</label>
                            <span><?php echo htmlspecialchars($submission['company']); ?></span>
                        </div>
                        <div class="detail-row">
                            <label>Email:</label>
                            <span><a href="mailto:<?php echo htmlspecialchars($submission['email']); ?>"><?php echo htmlspecialchars($submission['email']); ?></a></span>
                        </div>
                        <div class="detail-row">
                            <label>Mobile:</label>
                            <span><?php echo htmlspecialchars($submission['mobile']); ?></span>
                        </div>
                        <div class="detail-row">
                            <label>Message:</label>
                            <div class="message-content">
                                <?php echo nl2br(htmlspecialchars($submission['message'])); ?>
                            </div>
                        </div>
                    </div>
                    <div class="detail-actions">
                        <button class="action-btn" onclick="markAsReplied(<?php echo $id; ?>)">
                            <i class="fas fa-check"></i> Mark as Replied
                        </button>
                        <a href="mailto:<?php echo htmlspecialchars($submission['email']); ?>" class="action-btn">
                            <i class="fas fa-envelope"></i> Send Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function markAsReplied(id) {
        if(confirm('Are you sure you want to mark this submission as replied?')) {
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&status=replied`
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    document.querySelector('.status').className = 'status replied';
                    document.querySelector('.status').textContent = 'Replied';
                } else {
                    alert('Error updating status: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the status');
            });
        }
    }
    </script>
</body>
</html> 