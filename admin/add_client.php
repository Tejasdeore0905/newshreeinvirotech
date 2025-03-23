<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $website = $_POST['website'] ?? '';
    $description = $_POST['description'] ?? '';
    
    if (empty($name)) {
        $error = "Client name is required";
    } else {
        // Handle logo upload
        $logo_path = '';
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
            $target_dir = "../uploads/clients/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $file_extension = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
            $new_filename = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
                $logo_path = $target_file;
            }
        }
        
        $stmt = $conn->prepare("INSERT INTO clients (name, logo, website, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $logo_path, $website, $description);
        
        if ($stmt->execute()) {
            $success = "Client added successfully!";
            // Log the activity
            $activity = "Added new client: $name";
            $admin_id = $_SESSION['admin_id'];
            $log_stmt = $conn->prepare("INSERT INTO admin_activity_log (admin_id, activity) VALUES (?, ?)");
            $log_stmt->bind_param("is", $admin_id, $activity);
            $log_stmt->execute();
            
            // Redirect after 2 seconds
            header("refresh:2;url=manage-clients.php");
        } else {
            $error = "Error adding client: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Client - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .main-content {
            flex: 1;
            background: #f8f9fa;
            padding: 20px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-title {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .submit-btn, .back-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .submit-btn {
            background: #28a745;
            color: white;
        }

        .back-btn {
            background: #6c757d;
            color: white;
            text-decoration: none;
        }

        .submit-btn:hover, .back-btn:hover {
            opacity: 0.9;
        }

        .error {
            color: #dc3545;
            margin-bottom: 15px;
        }

        .success {
            color: #28a745;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="main-content">
            <div class="form-container">
                <h2 class="form-title">Add New Client</h2>

                <?php if (!empty($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <p class="success"><?php echo htmlspecialchars($success); ?></p>
                <?php endif; ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Client Name:</label>
                        <input type="text" name="name" id="name" required>
                    </div>

                    <div class="form-group">
                        <label for="logo">Client Logo:</label>
                        <input type="file" name="logo" id="logo" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="website">Website URL:</label>
                        <input type="url" name="website" id="website">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description"></textarea>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="submit-btn">Add Client</button>
                        <a href="manage-clients.php" class="back-btn">Back to Clients</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
