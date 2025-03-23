<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate data
    $errors = [];
    if (empty($name)) $errors[] = "Name is required";
    if (empty($company)) $errors[] = "Company name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($mobile)) $errors[] = "Mobile number is required";
    if (empty($message)) $errors[] = "Message is required";

    if (empty($errors)) {
        try {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO contact_submissions (name, company, email, mobile, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $company, $email, $mobile, $message]);

            // Prepare email content
            $admin_subject = 'New Contact Form Submission - Shree Enviro Tech';
            $admin_message = "
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Company:</strong> {$company}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Mobile:</strong> {$mobile}</p>
                <p><strong>Message:</strong></p>
                <p>{$message}</p>
            ";

            $user_subject = 'Thank You for Contacting Shree Enviro Tech';
            $user_message = "
                <h2>Thank You for Contacting Us</h2>
                <p>Dear {$name},</p>
                <p>We have received your message and will get back to you shortly.</p>
                <p>Best regards,<br>Shree Enviro Tech Team</p>
            ";

            // Email headers
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "From: " . SMTP_FROM_NAME . " <" . SMTP_FROM . ">\r\n";
            $headers .= "Reply-To: {$email}\r\n";

            // Send email to admin
            mail(SMTP_USER, $admin_subject, $admin_message, $headers);

            // Send confirmation to user
            mail($email, $user_subject, $user_message, $headers);

            // Redirect with success message
            header("Location: contact_us.php?status=success");
            exit();

        } catch (Exception $e) {
            // Log error and redirect with error message
            error_log("Error: " . $e->getMessage());
            header("Location: contact_us.php?status=error");
            exit();
        }
    } else {
        // Redirect with validation errors
        $errorString = implode(',', $errors);
        header("Location: contact_us.php?status=error&message=" . urlencode($errorString));
        exit();
    }
} else {
    // If someone tries to access this file directly without POST data
    header("Location: contact_us.php");
    exit();
}
?>
