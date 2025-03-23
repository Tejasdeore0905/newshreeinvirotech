<?php
session_start();
require_once('../includes/db_config.php');

// Check if user is logged in
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$overview = $features = $benefits = $heading = $subheading = "";
$project_error = "";
$project_success = "";
$image_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $overview = isset($_POST["overview"]) ? $_POST["overview"] : "";
    $features = isset($_POST["features"]) ? $_POST["features"] : "";
    $benefits = isset($_POST["benefits"]) ? $_POST["benefits"] : "";
    $heading = isset($_POST["heading"]) ? $_POST["heading"] : "";
    $subheading = isset($_POST["subheading"]) ? $_POST["subheading"] : "";

    if (empty($overview) || empty($features) || empty($benefits) || empty($heading) || empty($subheading)) {
        $project_error = "All project fields are required";
    } else {
        $overview = $conn->real_escape_string($overview);
        $features = $conn->real_escape_string($features);
        $benefits = $conn->real_escape_string($benefits);
        $heading = $conn->real_escape_string($heading);
        $subheading = $conn->real_escape_string($subheading);

        // Convert benefits to a comma-separated string
        $benefits_array = explode("\n", $benefits);
        $benefits = implode(", ", array_map('trim', $benefits_array));
        
        // Image Upload Logic
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $image_error = "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
            $image_error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $image_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $project_error = $image_error;
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO projects (heading, subheading, overview, features, benefits, image_path) VALUES ('$heading', '$subheading', '$overview', '$features', '$benefits', '$target_file')";

                if ($conn->query($sql) === TRUE) {
                    $project_success = "Project added successfully!";
                    // Clear form fields after successful submission
                    $overview = $features = $benefits = $heading = $subheading = "";
                    // Redirect to projects page after 2 seconds
                    header("refresh:2;url=projects.php");
                } else {
                    $project_error = "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $project_error = "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Project - Admin Dashboard</title>
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

        .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="main-content">
            <div class="form-container">
                <h2 class="form-title">Add New Project</h2>

                <?php if (!empty($project_error)) : ?>
                    <p class="error"><?php echo $project_error; ?></p>
                <?php endif; ?>

                <?php if (!empty($project_success)) : ?>
                    <p class="success"><?php echo $project_success; ?></p>
                <?php endif; ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="heading">Project Heading:</label>
                        <input type="text" name="heading" id="heading" value="<?php echo htmlspecialchars($heading); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="subheading">Project Subheading:</label>
                        <input type="text" name="subheading" id="subheading" value="<?php echo htmlspecialchars($subheading); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Project Image:</label>
                        <input type="file" name="image" id="image" required>
                        <p class="help-text">Allowed formats: JPG, JPEG, PNG, GIF. Max size: 5MB</p>
                    </div>

                    <div class="form-group">
                        <label for="overview">Project Overview:</label>
                        <textarea name="overview" id="overview" required><?php echo htmlspecialchars($overview); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="features">Key Features:</label>
                        <textarea name="features" id="features" required><?php echo htmlspecialchars($features); ?></textarea>
                        <p class="help-text">Enter each feature on a new line</p>
                    </div>

                    <div class="form-group">
                        <label for="benefits">Benefits:</label>
                        <textarea name="benefits" id="benefits" required><?php echo htmlspecialchars($benefits); ?></textarea>
                        <p class="help-text">Enter each benefit on a new line</p>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="submit-btn">Add Project</button>
                        <a href="projects.php" class="back-btn">Back to Projects</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
