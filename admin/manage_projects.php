<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$success = $error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add' || $_POST['action'] == 'edit') {
            $title = $_POST['title'] ?? '';
            $client = $_POST['client'] ?? '';
            $completion_date = $_POST['completion_date'] ?? '';
            $description = $_POST['description'] ?? '';
            $location = $_POST['location'] ?? '';
            $category = $_POST['category'] ?? '';
            
            // Handle image upload
            $image_path = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = '../uploads/projects/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_name = time() . '_' . $_FILES['image']['name'];
                $target_file = $upload_dir . $file_name;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $image_path = '/uploads/projects/' . $file_name;
                } else {
                    $error = "Failed to upload image.";
                }
            }
            
            if ($_POST['action'] == 'add') {
                $stmt = $conn->prepare("INSERT INTO projects (title, client, completion_date, description, location, category, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $title, $client, $completion_date, $description, $location, $category, $image_path);
                
                if ($stmt->execute()) {
                    $success = "Project added successfully!";
                } else {
                    $error = "Error adding project: " . $conn->error;
                }
            } else {
                $id = $_POST['project_id'] ?? 0;
                if ($image_path) {
                    $stmt = $conn->prepare("UPDATE projects SET title = ?, client = ?, completion_date = ?, description = ?, location = ?, category = ?, image = ? WHERE id = ?");
                    $stmt->bind_param("sssssssi", $title, $client, $completion_date, $description, $location, $category, $image_path, $id);
                } else {
                    $stmt = $conn->prepare("UPDATE projects SET title = ?, client = ?, completion_date = ?, description = ?, location = ?, category = ? WHERE id = ?");
                    $stmt->bind_param("ssssssi", $title, $client, $completion_date, $description, $location, $category, $id);
                }
                
                if ($stmt->execute()) {
                    $success = "Project updated successfully!";
                } else {
                    $error = "Error updating project: " . $conn->error;
                }
            }
        } elseif ($_POST['action'] == 'delete') {
            $id = $_POST['project_id'] ?? 0;
            
            // Get image path before deleting
            $stmt = $conn->prepare("SELECT image FROM projects WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $image_path = $row['image'];
                if ($image_path && file_exists(".." . $image_path)) {
                    unlink(".." . $image_path);
                }
            }
            
            $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $success = "Project deleted successfully!";
            } else {
                $error = "Error deleting project: " . $conn->error;
            }
        }
    }
}

// Get all projects
$query = "SELECT * FROM projects ORDER BY completion_date DESC";
$projects = $conn->query($query);

// Get all clients for dropdown
$clients_query = "SELECT id, name FROM clients ORDER BY name ASC";
$clients = $conn->query($clients_query);
$clients_list = [];
while ($client = $clients->fetch_assoc()) {
    $clients_list[] = $client;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Manage Projects</h2>
                <button class="btn btn-primary" onclick="showAddForm()">
                    <i class="fas fa-plus"></i> Add New Project
                </button>
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Add/Edit Project Form -->
            <div id="projectForm" class="content-form" style="display: none;">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="project_id" id="projectId" value="">
                    
                    <div class="form-group">
                        <label for="title">Project Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="client">Client</label>
                        <select id="client" name="client" required>
                            <option value="">Select Client</option>
                            <?php foreach ($clients_list as $client): ?>
                                <option value="<?php echo htmlspecialchars($client['name']); ?>">
                                    <?php echo htmlspecialchars($client['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="completion_date">Completion Date</label>
                        <input type="date" id="completion_date" name="completion_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="water_treatment">Water Treatment</option>
                            <option value="waste_management">Waste Management</option>
                            <option value="air_quality">Air Quality</option>
                            <option value="environmental_consulting">Environmental Consulting</option>
                            <option value="renewable_energy">Renewable Energy</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Project Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <div id="currentImage"></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Project
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="hideForm()">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Projects List -->
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Client</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Completion Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($project = $projects->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php if ($project['image']): ?>
                                        <img src="<?php echo htmlspecialchars($project['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($project['title']); ?>"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <i class="fas fa-project-diagram fa-2x"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($project['title']); ?></td>
                                <td><?php echo htmlspecialchars($project['client']); ?></td>
                                <td><?php echo htmlspecialchars($project['location']); ?></td>
                                <td><?php echo str_replace('_', ' ', ucfirst($project['category'])); ?></td>
                                <td><?php echo date('M d, Y', strtotime($project['completion_date'])); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editProject(<?php echo $project['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteProject(<?php echo $project['id']; ?>)">
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
            document.getElementById('projectForm').style.display = 'block';
            document.getElementById('formAction').value = 'add';
            document.getElementById('projectId').value = '';
            // Clear form fields
            document.getElementById('title').value = '';
            document.getElementById('client').value = '';
            document.getElementById('completion_date').value = '';
            document.getElementById('location').value = '';
            document.getElementById('category').value = 'water_treatment';
            document.getElementById('description').value = '';
            document.getElementById('currentImage').innerHTML = '';
        }

        function hideForm() {
            document.getElementById('projectForm').style.display = 'none';
        }

        function editProject(id) {
            // In a real application, you would fetch the project details via AJAX
            // For now, we'll just show the form
            document.getElementById('projectForm').style.display = 'block';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('projectId').value = id;
        }

        function deleteProject(id) {
            if (confirm('Are you sure you want to delete this project?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="project_id" value="${id}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
