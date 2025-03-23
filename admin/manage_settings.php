<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle settings update
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach($_POST as $key => $value) {
        if(strpos($key, 'setting_') === 0) {
            $setting_key = substr($key, 8); // Remove 'setting_' prefix
            $stmt = $conn->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");
            $stmt->bind_param("ss", $value, $setting_key);
            $stmt->execute();
        }
    }

    // Handle logo upload
    if(isset($_FILES['setting_company_logo']) && $_FILES['setting_company_logo']['error'] == 0) {
        $target_dir = "../uploads/settings/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = strtolower(pathinfo($_FILES['setting_company_logo']['name'], PATHINFO_EXTENSION));
        $new_filename = 'company_logo_' . time() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if(move_uploaded_file($_FILES['setting_company_logo']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = 'company_logo'");
            $stmt->bind_param("s", $target_file);
            $stmt->execute();
        }
    }

    // Log the activity
    $activity = "Updated website settings";
    $admin_id = $_SESSION['admin_id'];
    $log_stmt = $conn->prepare("INSERT INTO admin_activity_log (admin_id, activity) VALUES (?, ?)");
    $log_stmt->bind_param("is", $admin_id, $activity);
    $log_stmt->execute();

    $_SESSION['success'] = "Settings updated successfully!";
    header("Location: manage_settings.php");
    exit();
}

// Get all settings grouped by category
$settings_query = "SELECT * FROM site_settings ORDER BY setting_group, setting_label";
$settings_result = $conn->query($settings_query);

$settings_by_group = [];
while($setting = $settings_result->fetch_assoc()) {
    $settings_by_group[$setting['setting_group']][] = $setting;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Settings - Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .settings-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .settings-card h3 {
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            color: #333;
            text-transform: capitalize;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="url"],
        .form-group input[type="color"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .current-logo {
            max-width: 200px;
            margin: 10px 0;
        }

        .color-preview {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            vertical-align: middle;
            margin-left: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include('includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h2>Website Settings</h2>
            </div>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="settings-grid">
                    <?php foreach($settings_by_group as $group => $settings): ?>
                        <div class="settings-card">
                            <h3><?php echo ucwords(str_replace('_', ' ', $group)); ?></h3>
                            <?php foreach($settings as $setting): ?>
                                <div class="form-group">
                                    <label for="setting_<?php echo $setting['setting_key']; ?>">
                                        <?php echo $setting['setting_label']; ?>
                                    </label>
                                    
                                    <?php if($setting['setting_type'] == 'textarea'): ?>
                                        <textarea name="setting_<?php echo $setting['setting_key']; ?>" 
                                                id="setting_<?php echo $setting['setting_key']; ?>"><?php echo htmlspecialchars($setting['setting_value']); ?></textarea>
                                    
                                    <?php elseif($setting['setting_type'] == 'image'): ?>
                                        <?php if(!empty($setting['setting_value'])): ?>
                                            <img src="<?php echo htmlspecialchars($setting['setting_value']); ?>" 
                                                 alt="Current <?php echo $setting['setting_label']; ?>" 
                                                 class="current-logo">
                                        <?php endif; ?>
                                        <input type="file" name="setting_<?php echo $setting['setting_key']; ?>" 
                                               id="setting_<?php echo $setting['setting_key']; ?>" 
                                               accept="image/*">
                                    
                                    <?php elseif($setting['setting_type'] == 'color'): ?>
                                        <input type="color" name="setting_<?php echo $setting['setting_key']; ?>" 
                                               id="setting_<?php echo $setting['setting_key']; ?>" 
                                               value="<?php echo htmlspecialchars($setting['setting_value']); ?>">
                                        <span class="color-preview" style="background-color: <?php echo htmlspecialchars($setting['setting_value']); ?>"></span>
                                    
                                    <?php else: ?>
                                        <input type="<?php echo $setting['setting_type']; ?>" 
                                               name="setting_<?php echo $setting['setting_key']; ?>" 
                                               id="setting_<?php echo $setting['setting_key']; ?>" 
                                               value="<?php echo htmlspecialchars($setting['setting_value']); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Update color preview when color input changes
        document.querySelectorAll('input[type="color"]').forEach(input => {
            input.addEventListener('input', function() {
                this.nextElementSibling.style.backgroundColor = this.value;
            });
        });
    </script>
</body>
</html>
