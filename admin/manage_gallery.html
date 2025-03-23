<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$success = $error = '';

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['images'])) {
        $upload_dir = '../uploads/gallery/';
        
        // Create directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $total = count($_FILES['images']['name']);
        $success_count = 0;
        
        for ($i = 0; $i < $total; $i++) {
            $tmpFilePath = $_FILES['images']['tmp_name'][$i];
            
            if ($tmpFilePath != "") {
                $newFilePath = $upload_dir . time() . '_' . $_FILES['images']['name'][$i];
                
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    // Insert into gallery table
                    $caption = $_POST['captions'][$i] ?? '';
                    $category = $_POST['category'] ?? 'general';
                    $relative_path = str_replace('..', '', $newFilePath);
                    
                    $stmt = $conn->prepare("INSERT INTO gallery (image_path, caption, category) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $relative_path, $caption, $category);
                    
                    if ($stmt->execute()) {
                        $success_count++;
                    }
                }
            }
        }
        
        if ($success_count > 0) {
            $success = "$success_count images uploaded successfully!";
        } else {
            $error = "Error uploading images.";
        }
    }
}

// Get all gallery images
$query = "SELECT * FROM gallery ORDER BY created_at DESC";
$images = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        
        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .gallery-item .caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 8px;
            font-size: 14px;
        }
        
        .gallery-item .actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }
        
        .upload-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Manage Gallery</h2>
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Upload Form -->
            <div class="upload-form">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="images">Upload Images</label>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="general">General</option>
                            <option value="projects">Projects</option>
                            <option value="events">Events</option>
                            <option value="facilities">Facilities</option>
                        </select>
                    </div>
                    
                    <div id="captions-container">
                        <!-- Captions will be added dynamically via JavaScript -->
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Images
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <?php while ($image = $images->fetch_assoc()): ?>
                    <div class="gallery-item">
                        <img src="<?php echo htmlspecialchars($image['image_path']); ?>" 
                             alt="<?php echo htmlspecialchars($image['caption']); ?>">
                        <div class="caption"><?php echo htmlspecialchars($image['caption']); ?></div>
                        <div class="actions">
                            <button class="btn btn-sm btn-danger" onclick="deleteImage(<?php echo $image['id']; ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script>
        // Handle file input change to show caption fields
        document.getElementById('images').addEventListener('change', function(e) {
            const container = document.getElementById('captions-container');
            container.innerHTML = ''; // Clear previous fields
            
            for (let i = 0; i < this.files.length; i++) {
                const div = document.createElement('div');
                div.className = 'form-group';
                div.innerHTML = `
                    <label>Caption for ${this.files[i].name}</label>
                    <input type="text" name="captions[]" placeholder="Enter caption">
                `;
                container.appendChild(div);
            }
        });

        function deleteImage(id) {
            if (confirm('Are you sure you want to delete this image?')) {
                // Submit delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="image_id" value="${id}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
