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
            $date = $_POST['date'] ?? '';
            $description = $_POST['description'] ?? '';
            $location = $_POST['location'] ?? '';
            $status = $_POST['status'] ?? 'upcoming';
            
            // Handle image upload
            $image_path = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = '../uploads/events/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_name = time() . '_' . $_FILES['image']['name'];
                $target_file = $upload_dir . $file_name;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $image_path = '/uploads/events/' . $file_name;
                } else {
                    $error = "Failed to upload image.";
                }
            }
            
            if ($_POST['action'] == 'add') {
                $stmt = $conn->prepare("INSERT INTO events (title, date, description, location, image, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $title, $date, $description, $location, $image_path, $status);
                
                if ($stmt->execute()) {
                    $success = "Event added successfully!";
                } else {
                    $error = "Error adding event: " . $conn->error;
                }
            } else {
                $id = $_POST['event_id'] ?? 0;
                if ($image_path) {
                    $stmt = $conn->prepare("UPDATE events SET title = ?, date = ?, description = ?, location = ?, image = ?, status = ? WHERE id = ?");
                    $stmt->bind_param("ssssssi", $title, $date, $description, $location, $image_path, $status, $id);
                } else {
                    $stmt = $conn->prepare("UPDATE events SET title = ?, date = ?, description = ?, location = ?, status = ? WHERE id = ?");
                    $stmt->bind_param("sssssi", $title, $date, $description, $location, $status, $id);
                }
                
                if ($stmt->execute()) {
                    $success = "Event updated successfully!";
                } else {
                    $error = "Error updating event: " . $conn->error;
                }
            }
        } elseif ($_POST['action'] == 'delete') {
            $id = $_POST['event_id'] ?? 0;
            
            // Get image path before deleting
            $stmt = $conn->prepare("SELECT image FROM events WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $image_path = $row['image'];
                if ($image_path && file_exists(".." . $image_path)) {
                    unlink(".." . $image_path);
                }
            }
            
            $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $success = "Event deleted successfully!";
            } else {
                $error = "Error deleting event: " . $conn->error;
            }
        }
    }
}

// Get all events
$query = "SELECT * FROM events ORDER BY date DESC";
$events = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Manage Events</h2>
                <button class="btn btn-primary" onclick="showAddForm()">
                    <i class="fas fa-plus"></i> Add New Event
                </button>
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Add/Edit Event Form -->
            <div id="eventForm" class="content-form" style="display: none;">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="event_id" id="eventId" value="">
                    
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="date">Event Date</label>
                        <input type="datetime-local" id="date" name="date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Event Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <div id="currentImage"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="upcoming">Upcoming</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Event
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="hideForm()">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Events List -->
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($event = $events->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php if ($event['image']): ?>
                                        <img src="<?php echo htmlspecialchars($event['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($event['title']); ?>"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <i class="fas fa-calendar fa-2x"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($event['title']); ?></td>
                                <td><?php echo date('M d, Y h:i A', strtotime($event['date'])); ?></td>
                                <td><?php echo htmlspecialchars($event['location']); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $event['status']; ?>">
                                        <?php echo ucfirst($event['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editEvent(<?php echo $event['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteEvent(<?php echo $event['id']; ?>)">
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
            document.getElementById('eventForm').style.display = 'block';
            document.getElementById('formAction').value = 'add';
            document.getElementById('eventId').value = '';
            // Clear form fields
            document.getElementById('title').value = '';
            document.getElementById('date').value = '';
            document.getElementById('location').value = '';
            document.getElementById('description').value = '';
            document.getElementById('status').value = 'upcoming';
            document.getElementById('currentImage').innerHTML = '';
        }

        function hideForm() {
            document.getElementById('eventForm').style.display = 'none';
        }

        function editEvent(id) {
            // In a real application, you would fetch the event details via AJAX
            // For now, we'll just show the form
            document.getElementById('eventForm').style.display = 'block';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('eventId').value = id;
        }

        function deleteEvent(id) {
            if (confirm('Are you sure you want to delete this event?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="event_id" value="${id}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
