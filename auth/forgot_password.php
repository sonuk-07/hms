<?php
session_start();
include '../Includes/dbConnection.php';

// Include Composer's autoloader
require '../vendor/autoload.php';  // Add this line at the top!

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Error and success messages
$error_message = "";
$success_message = "";

// Processing the forgot password request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if the email exists in the database
    $sql_check_email = "SELECT * FROM users WHERE email = ?";
    $stmt_check = mysqli_prepare($dbconn, $sql_check_email);
    mysqli_stmt_bind_param($stmt_check, "s", $email);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $user_data = mysqli_fetch_assoc($result_check);
    mysqli_stmt_close($stmt_check);

    if ($user_data) {
        // Generate a unique reset token
        $reset_token = bin2hex(random_bytes(32));
        $token_expiry = date("Y-m-d H:i:s", time()+60*30);

        // Store the reset token and expiry in the database
        $sql_update_token = "UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
        $stmt_update = mysqli_prepare($dbconn, $sql_update_token);
        mysqli_stmt_bind_param($stmt_update, "sss", $reset_token, $token_expiry, $email);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);

        // Send the reset email
        if (sendResetEmail($email, $reset_token)) {
            $success_message = "Password reset instructions have been sent to your email address.";
        } else {
            $error_message = "Failed to send reset email. Please try again.";
        }
    } else {
        $error_message = "Email address not found. Please enter the email address associated with your account.";
    }
}

function sendResetEmail($email, $token) {
    // PHPMailer configuration
    $mail = new PHPMailer(true); // true enables exceptions
    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through (replace with your SMTP server)
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'jaiswalsonukr7@gmail.com';                     // SMTP username (replace with your email address)
        $mail->Password   = 'tixo pfmm xufr owfs';                               // SMTP password (replace with your email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted, but STARTTLS is more modern
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS`

        // Recipients
        $mail->setFrom('noreply@yourdomain.com', 'CareFlow'); // Replace with your domain and a suitable name
        $mail->addAddress($email);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set to true for HTML email
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = 'Click the following link to reset your password:
                           <a href="http://localhost/HMS/auth/reset_password.php?token=' . $token . '">Reset Password</a>';
                           $mail->Body = 'Click the following link to reset your password:
                           <a href="http://localhost/HMS/auth/reset_password.php?token=' . $token . '">Reset Password</a>';
                           

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("PHPMailer Error: " . $e->getMessage());
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-light">
    <div class="container text-center mt-5">
        <h2 class="text-primary">CareFlow</h2>
        <p class="mb-4 text-secondary">Hospital Management System</p>
    </div>

    <div class="container">
        <div class="login-form-box mx-auto shadow p-4 bg-white rounded-4" style="max-width: 400px;">
            <h4 class="form-heading text-dark">Forgot Password</h4>
            <p class="form-subtext text-muted">Enter your email address to receive password reset instructions.</p>
            
            <?php if ($error_message) : ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <?php if ($success_message) : ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <form action="forgot_password.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </form>
            <p class="mt-3 text-center">Remembered your password? <a href="login.php" class="link-primary">Login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
