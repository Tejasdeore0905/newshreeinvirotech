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
    $hero_title = $_POST['hero_title'] ?? '';
    $hero_subtitle = $_POST['hero_subtitle'] ?? '';
    $about_content = $_POST['about_content'] ?? '';
    
    // Update home page content
    $stmt = $conn->prepare("UPDATE site_content SET 
        value = CASE 
            WHEN name = 'hero_title' THEN ?
            WHEN name = 'hero_subtitle' THEN ?
            WHEN name = 'about_content' THEN ?
        END
        WHERE name IN ('hero_title', 'hero_subtitle', 'about_content')");
    
    $stmt->bind_param("sss", $hero_title, $hero_subtitle, $about_content);
    
    if ($stmt->execute()) {
        $success = "Home page content updated successfully!";
    } else {
        $error = "Error updating content: " . $conn->error;
    }
}

// Get current content
$query = "SELECT * FROM site_content WHERE name IN ('hero_title', 'hero_subtitle', 'about_content')";
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
    <title>Manage Home Page - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Manage Home Page</h2>
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
                        <label for="hero_title">Hero Title</label>
                        <input type="text" id="hero_title" name="hero_title" 
                               value="<?php echo htmlspecialchars($content['hero_title'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="hero_subtitle">Hero Subtitle</label>
                        <input type="text" id="hero_subtitle" name="hero_subtitle" 
                               value="<?php echo htmlspecialchars($content['hero_subtitle'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="about_content">About Content</label>
                        <textarea id="about_content" name="about_content" rows="6" required><?php 
                            echo htmlspecialchars($content['about_content'] ?? ''); 
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
