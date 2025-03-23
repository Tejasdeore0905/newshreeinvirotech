<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$success = $error = '';

// Handle form submission for adding/editing service
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $icon = $_POST['icon'] ?? '';
        
        if ($_POST['action'] == 'add') {
            $stmt = $conn->prepare("INSERT INTO services (title, description, icon, status) VALUES (?, ?, ?, 'active')");
            $stmt->bind_param("sss", $title, $description, $icon);
            
            if ($stmt->execute()) {
                $success = "Service added successfully!";
            } else {
                $error = "Error adding service: " . $conn->error;
            }
        } elseif ($_POST['action'] == 'edit') {
            $id = $_POST['service_id'] ?? 0;
            $stmt = $conn->prepare("UPDATE services SET title = ?, description = ?, icon = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $description, $icon, $id);
            
            if ($stmt->execute()) {
                $success = "Service updated successfully!";
            } else {
                $error = "Error updating service: " . $conn->error;
            }
        }
    }
}

// Get all services
$query = "SELECT * FROM services ORDER BY id DESC";
$services = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Manage Services</h2>
                <button class="btn btn-primary" onclick="showAddForm()">
                    <i class="fas fa-plus"></i> Add New Service
                </button>
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Add/Edit Service Form -->
            <div id="serviceForm" class="content-form" style="display: none;">
                <form method="POST" action="">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="service_id" id="serviceId" value="">
                    
                    <div class="form-group">
                        <label for="title">Service Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="icon">Icon (FontAwesome class)</label>
                        <input type="text" id="icon" name="icon" placeholder="fas fa-cog" required>
                        <small>Example: fas fa-cog, fas fa-wrench, etc.</small>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Service
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="hideForm()">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Services List -->
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($service = $services->fetch_assoc()): ?>
                            <tr>
                                <td><i class="<?php echo htmlspecialchars($service['icon']); ?>"></i></td>
                                <td><?php echo htmlspecialchars($service['title']); ?></td>
                                <td><?php echo htmlspecialchars($service['description']); ?></td>
                                <td><?php echo ucfirst($service['status']); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editService(<?php echo $service['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteService(<?php echo $service['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showAddForm() {
            document.getElementById('serviceForm').style.display = 'block';
            document.getElementById('formAction').value = 'add';
            document.getElementById('serviceId').value = '';
            // Clear form fields
            document.getElementById('title').value = '';
            document.getElementById('description').value = '';
            document.getElementById('icon').value = '';
        }

        function hideForm() {
            document.getElementById('serviceForm').style.display = 'none';
        }

        function editService(id) {
            // In a real application, you would fetch the service details via AJAX
            // For now, we'll just show the form
            document.getElementById('serviceForm').style.display = 'block';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('serviceId').value = id;
        }

        function deleteService(id) {
            if (confirm('Are you sure you want to delete this service?')) {
                // Submit delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="service_id" value="${id}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
