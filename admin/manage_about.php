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
    $about_content = $_POST['about_content'] ?? '';
    $vision = $_POST['vision'] ?? '';
    $mission = $_POST['mission'] ?? '';
    
    // Update about page content
    $stmt = $conn->prepare("UPDATE site_content SET 
        value = CASE 
            WHEN name = 'about_content' THEN ?
            WHEN name = 'company_vision' THEN ?
            WHEN name = 'company_mission' THEN ?
        END
        WHERE name IN ('about_content', 'company_vision', 'company_mission')");
    
    $stmt->bind_param("sss", $about_content, $vision, $mission);
    
    if ($stmt->execute()) {
        $success = "About page content updated successfully!";
    } else {
        $error = "Error updating content: " . $conn->error;
    }
}

// Get current content
$query = "SELECT * FROM site_content WHERE section = 'about'";
$result = $conn->query($query);
$content = [];
while ($row = $result->fetch_assoc()) {
    $content[$row['name']] = $row['value'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage About Page - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#about_content',
            height: 300,
            plugins: 'lists link image code',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code'
        });
    </script>
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Manage About Page</h2>
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="content-form">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="about_content">About Content</label>
                        <textarea id="about_content" name="about_content" class="tinymce"><?php 
                            echo htmlspecialchars($content['about_content'] ?? ''); 
                        ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="vision">Company Vision</label>
                        <textarea id="vision" name="vision" rows="4" required><?php 
                            echo htmlspecialchars($content['company_vision'] ?? ''); 
                        ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="mission">Company Mission</label>
                        <textarea id="mission" name="mission" rows="4" required><?php 
                            echo htmlspecialchars($content['company_mission'] ?? ''); 
                        ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
