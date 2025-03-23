<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $title = $_POST['title'];
                $date = $_POST['date'];
                $description = $_POST['description'];
                
                // Handle image uploads
                $image_paths = [];
                if (isset($_FILES['images'])) {
                    $upload_dir = '../assets/events/';
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                        $file_name = $_FILES['images']['name'][$key];
                        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                        $new_name = uniqid() . '.' . $file_ext;
                        $target_path = $upload_dir . $new_name;
                        
                        if (move_uploaded_file($tmp_name, $target_path)) {
                            $image_paths[] = 'assets/events/' . $new_name;
                        }
                    }
                }
                
                $stmt = $conn->prepare("INSERT INTO events (title, date, description, images) VALUES (?, ?, ?, ?)");
                $images_json = json_encode($image_paths);
                $stmt->bind_param("ssss", $title, $date, $description, $images_json);
                $stmt->execute();
                
                // Log activity
                $admin_id = $_SESSION['admin_id'];
                $activity = "Added new event: " . $title;
                $stmt = $conn->prepare("INSERT INTO admin_activity_log (admin_id, activity) VALUES (?, ?)");
                $stmt->bind_param("is", $admin_id, $activity);
                $stmt->execute();
                
                break;
                
            case 'edit':
                $event_id = $_POST['event_id'];
                $title = $_POST['title'];
                $date = $_POST['date'];
                $description = $_POST['description'];
                
                // Handle image uploads
                $image_paths = [];
                if (isset($_FILES['images']) && $_FILES['images']['name'][0] !== '') {
                    $upload_dir = '../assets/events/';
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                        $file_name = $_FILES['images']['name'][$key];
                        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                        $new_name = uniqid() . '.' . $file_ext;
                        $target_path = $upload_dir . $new_name;
                        
                        if (move_uploaded_file($tmp_name, $target_path)) {
                            $image_paths[] = 'assets/events/' . $new_name;
                        }
                    }
                    
                    // Update with new images
                    $stmt = $conn->prepare("UPDATE events SET title = ?, date = ?, description = ?, images = ? WHERE id = ?");
                    $images_json = json_encode($image_paths);
                    $stmt->bind_param("ssssi", $title, $date, $description, $images_json, $event_id);
                } else {
                    // Update without changing images
                    $stmt = $conn->prepare("UPDATE events SET title = ?, date = ?, description = ? WHERE id = ?");
                    $stmt->bind_param("sssi", $title, $date, $description, $event_id);
                }
                
                $stmt->execute();
                
                // Log activity
                $admin_id = $_SESSION['admin_id'];
                $activity = "Updated event: " . $title;
                $stmt = $conn->prepare("INSERT INTO admin_activity_log (admin_id, activity) VALUES (?, ?)");
                $stmt->bind_param("is", $admin_id, $activity);
                $stmt->execute();
                
                break;
                
            case 'delete':
                $event_id = $_POST['event_id'];
                
                // Get image paths before deleting
                $stmt = $conn->prepare("SELECT images FROM events WHERE id = ?");
                $stmt->bind_param("i", $event_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $event = $result->fetch_assoc();
                
                // Delete images from server
                if ($event && $event['images']) {
                    $images = json_decode($event['images'], true);
                    foreach ($images as $image) {
                        $file_path = '../' . $image;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                }
                
                // Delete from database
                $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
                $stmt->bind_param("i", $event_id);
                $stmt->execute();
                
                // Log activity
                $admin_id = $_SESSION['admin_id'];
                $activity = "Deleted event ID: " . $event_id;
                $stmt = $conn->prepare("INSERT INTO admin_activity_log (admin_id, activity) VALUES (?, ?)");
                $stmt->bind_param("is", $admin_id, $activity);
                $stmt->execute();
                
                break;
        }
        
        // Redirect to prevent form resubmission
        header("Location: events.php");
        exit();
    }
}

// Get all events
$events_query = "SELECT * FROM events ORDER BY date DESC";
$events_result = $conn->query($events_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: #000000;
            color: white;
            padding: 20px 0;
        }

        .admin-logo {
            width: 100%;
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
            filter: brightness(0) invert(1); /* This will make the logo white */
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: #ffffff;
            color: #000000;
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        .nav-link.active {
            background: #ffffff;
            color: #000000;
        }

        /* Update sidebar navigation styles */
        .sidebar-nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav ul li {
            margin: 5px 0;
        }

        .sidebar-nav ul li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-nav ul li a:hover {
            background: #ffffff;
            color: #000000;
        }

        .sidebar-nav ul li.active a {
            background: #ffffff;
            color: #000000;
        }

        .sidebar-nav ul li i {
            margin-right: 10px;
            width: 20px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            background: #ffffff;
            padding: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: #000000;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .page-title {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .add-event-btn {
            background: #ffffff;
            color: #000000;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .add-event-btn:hover {
            background: #f0f0f0;
            color: #000000;
        }

        /* Events List */
        .events-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .event-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            border: 1px solid #000000;
        }

        .event-image {
            width: 200px;
            height: 150px;
            object-fit: cover;
        }

        .event-content {
            flex: 1;
            padding: 20px;
        }

        .event-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .event-title {
            font-size: 1.2rem;
            color: #000000;
            margin-bottom: 5px;
        }

        .event-date {
            color: #666666;
            font-size: 0.9rem;
        }

        .event-description {
            color: #333333;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .event-actions {
            display: flex;
            gap: 10px;
        }

        .edit-btn, .delete-btn {
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: #ffffff;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .edit-btn {
            background: #000000;
        }

        .delete-btn {
            background: #333333;
        }

        .edit-btn:hover, .delete-btn:hover {
            opacity: 0.9;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background: #ffffff;
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: 1px solid #000000;
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #000000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #000000;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #000000;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #000000;
            outline: none;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .submit-btn {
            background: #000000;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background: #333333;
        }

        /* Image Gallery */
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .gallery-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid #000000;
        }

        .gallery-image:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .admin-container {
                flex-direction: row;
            }

            .sidebar {
                width: 200px;
            }

            .main-content {
                padding: 15px;
            }

            .event-card {
                flex-direction: row;
            }

            .event-image {
                width: 180px;
                height: 140px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 180px;
            }

            .nav-link {
                padding: 10px 15px;
            }

            .event-card {
                flex-direction: column;
            }

            .event-image {
                width: 100%;
                height: 200px;
            }

            .event-actions {
                flex-direction: column;
                gap: 5px;
            }

            .edit-btn, .delete-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 10px 0;
            }

            .sidebar-header {
                padding: 10px 15px;
            }

            .sidebar-header h3 {
                font-size: 1.2rem;
                padding: 3px 8px;
            }

            .nav-menu {
                padding: 10px 0;
            }

            .main-content {
                padding: 10px;
            }

            .top-bar {
                flex-direction: column;
                gap: 10px;
                text-align: center;
                padding: 10px;
            }

            .user-info {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .event-card {
                margin: 10px 0;
            }

            .event-content {
                padding: 15px;
            }

            .event-header {
                flex-direction: column;
                gap: 10px;
            }

            .event-actions {
                width: 100%;
            }

            .image-gallery {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 5px;
            }

            .gallery-image {
                height: 80px;
            }
        }

        @media (max-width: 576px) {
            .sidebar-header h3 {
                font-size: 1rem;
                
            }

            .nav-link {
                padding: 8px 12px;
                font-size: 0.9rem;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .event-title {
                font-size: 1.1rem;
            }

            .event-description {
                font-size: 0.85rem;
            }

            .modal-content {
                width: 95%;
                margin: 20px auto;
                padding: 15px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                font-size: 0.9rem;
            }

            .form-group input,
            .form-group textarea {
                padding: 6px;
                font-size: 0.9rem;
            }

            .submit-btn {
                width: 100%;
                padding: 8px 15px;
            }

            .image-gallery {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .gallery-image {
                height: 70px;
            }
        }

        /* Add smooth transitions */
        .admin-container,
        .sidebar,
        .main-content,
        .event-card,
        .nav-link,
        .form-group input,
        .form-group textarea,
        .submit-btn,
        .gallery-image {
            transition: all 0.3s ease;
        }

        /* Improve touch targets for mobile */
        @media (hover: none) {
            .nav-link,
            .edit-btn,
            .delete-btn,
            .submit-btn {
                padding: 12px 15px;
            }

            .gallery-image {
                cursor: default;
            }
        }

        /* Fix modal scrolling on mobile */
        .modal {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .modal-content {
            margin: 20px auto;
            max-height: 90vh;
            overflow-y: auto;
        }

        /* User Info and Logout */
        .user-info {
            color: #ffffff;
        }

        .logout-btn {
            color: #ffffff;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ffffff;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #ffffff;
            color: #000000;
        }

        /* Form Text */
        .form-text {
            color: #666666;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        /* Active Navigation Link */
        .nav-link.active {
            background: #ffffff;
            color: #000000;
        }

        /* Hover Effects */
        .nav-link:hover {
            background: #ffffff;
            color: #000000;
        }

        /* Modal Background */
        .modal {
            background: rgba(0, 0, 0, 0.8);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .top-bar {
                background: #000000;
            }
            
            .page-title {
                color: #ffffff;
            }
            
            .user-info {
                color: #ffffff;
            }
            
            .logout-btn {
                color: #ffffff;
                border-color: #ffffff;
            }
            
            .logout-btn:hover {
                background: #ffffff;
                color: #000000;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="../assets/logo.png" alt="Logo" class="admin-logo">
                <h3>Admin Panel</h3>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
                    <li><a href="services.php"><i class="fas fa-cogs"></i> Services</a></li>
                    <li class="active"><a href="events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
                    <li><a href="clients.php"><i class="fas fa-users"></i> Clients</a></li>
                    <li><a href="submissions.php"><i class="fas fa-envelope"></i> Submissions</a></li>
                    <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-bar">
                <h2>Manage Events</h2>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Events List -->
            <div class="events-list">
                <?php while($event = $events_result->fetch_assoc()): 
                    $images = json_decode($event['images'], true) ?? [];
                ?>
                <div class="event-card">
                    <img src="../<?php echo htmlspecialchars($images[0] ?? 'assets/placeholder.jpg'); ?>" 
                         alt="<?php echo htmlspecialchars($event['title']); ?>" 
                         class="event-image">
                    <div class="event-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h3>
                                <div class="event-date">
                                    <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($event['date']); ?>
                                </div>
                            </div>
                            <div class="event-actions">
                                <a href="#" class="edit-btn" onclick="openEditModal(<?php echo $event['id']; ?>, '<?php echo htmlspecialchars($event['title']); ?>', '<?php echo htmlspecialchars($event['date']); ?>', '<?php echo htmlspecialchars($event['description']); ?>')">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" class="delete-btn" onclick="deleteEvent(<?php echo $event['id']; ?>)">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                        <p class="event-description"><?php echo htmlspecialchars($event['description']); ?></p>
                        <?php if (!empty($images)): ?>
                        <div class="image-gallery">
                            <?php foreach($images as $image): ?>
                            <img src="../<?php echo htmlspecialchars($image); ?>" 
                                 alt="Event Image" 
                                 class="gallery-image">
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Add/Edit Event Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Add New Event</h2>
            <form id="eventForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="event_id" id="eventId">
                
                <div class="form-group">
                    <label for="eventTitle">Event Title</label>
                    <input type="text" id="eventTitle" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="eventDate">Event Date</label>
                    <input type="text" id="eventDate" name="date" required>
                </div>
                
                <div class="form-group">
                    <label for="eventDescription">Description</label>
                    <textarea id="eventDescription" name="description" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="eventImages">Event Images</label>
                    <input type="file" id="eventImages" name="images[]" accept="image/*" multiple>
                    <small class="form-text text-muted">Leave empty to keep existing images when editing</small>
                </div>
                
                <button type="submit" class="submit-btn">Save Event</button>
            </form>
        </div>
    </div>

    <script>
        // Initialize date picker
        flatpickr("#eventDate", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        function openModal() {
            document.getElementById('modalTitle').textContent = 'Add New Event';
            document.getElementById('formAction').value = 'add';
            document.getElementById('eventForm').reset();
            document.getElementById('eventModal').style.display = 'block';
        }

        function openEditModal(eventId, title, date, description) {
            document.getElementById('modalTitle').textContent = 'Edit Event';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('eventId').value = eventId;
            document.getElementById('eventTitle').value = title;
            document.getElementById('eventDate').value = date;
            document.getElementById('eventDescription').value = description;
            document.getElementById('eventModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('eventModal').style.display = 'none';
        }

        function deleteEvent(eventId) {
            if (confirm('Are you sure you want to delete this event?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="event_id" value="${eventId}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            var modal = document.getElementById('eventModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html> 