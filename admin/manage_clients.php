<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle client deletion
if(isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    // Get client info for logging
    $stmt = $conn->prepare("SELECT name FROM clients WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $client = $result->fetch_assoc();
    
    // Delete the client
    $delete_stmt = $conn->prepare("DELETE FROM clients WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    
    if($delete_stmt->execute()) {
        // Log the activity
        $activity = "Deleted client: " . $client['name'];
        $admin_id = $_SESSION['admin_id'];
        $log_stmt = $conn->prepare("INSERT INTO admin_activity_log (admin_id, activity) VALUES (?, ?)");
        $log_stmt->bind_param("is", $admin_id, $activity);
        $log_stmt->execute();
        
        $_SESSION['success'] = "Client deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting client.";
    }
    
    header("Location: manage_clients.php");
    exit();
}

// Get all clients
$clients = $conn->query("SELECT * FROM clients ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Manage Clients</h2>
                <a href="add_client.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Client
                </a>
            </div>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Website</th>
                            <th>Added Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($clients->num_rows > 0): ?>
                            <?php while($client = $clients->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <?php if(!empty($client['logo'])): ?>
                                            <img src="<?php echo htmlspecialchars($client['logo']); ?>" alt="<?php echo htmlspecialchars($client['name']); ?> logo" class="client-logo">
                                        <?php else: ?>
                                            <span class="no-logo">No Logo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($client['name']); ?></td>
                                    <td>
                                        <?php if(!empty($client['website'])): ?>
                                            <a href="<?php echo htmlspecialchars($client['website']); ?>" target="_blank">
                                                <?php echo htmlspecialchars($client['website']); ?>
                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('d M Y', strtotime($client['created_at'])); ?></td>
                                    <td>
                                        <span class="status-badge <?php echo $client['status']; ?>">
                                            <?php echo ucfirst($client['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="edit_client.php?id=<?php echo $client['id']; ?>" class="btn btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-delete" 
                                                    onclick="confirmDelete(<?php echo $client['id']; ?>, '<?php echo htmlspecialchars($client['name']); ?>')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="no-data">No clients found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            if(confirm('Are you sure you want to delete client "' + name + '"?')) {
                window.location.href = 'manage_clients.php?delete_id=' + id;
            }
        }
    </script>
</body>
</html>
