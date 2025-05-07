<?php
session_start();
include '../Includes/dbConnection.php';

// Error and success messages
$error_message = "";
$success_message = "";

// Check if the token is valid
if (!isset($_GET['token'])) {
    $error_message = "Invalid reset token.";
} else {
    $token = $_GET['token'];

    // Check if the token exists and is not expired
    $sql_check_token = "SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";

    $stmt_check = mysqli_prepare($dbconn, $sql_check_token);
    mysqli_stmt_bind_param($stmt_check, "s", $token);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $user_data = mysqli_fetch_assoc($result_check);
    mysqli_stmt_close($stmt_check);

    if (!$user_data) {
        $error_message = "Invalid or expired reset token.";
    } else {
        // Token is valid, process password reset
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];

            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the user's password and clear the reset token
                $sql_update_password = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?";
                $stmt_update = mysqli_prepare($dbconn, $sql_update_password);
                mysqli_stmt_bind_param($stmt_update, "ss", $hashed_password, $user_data['email']); // Use email to identify the user.
                mysqli_stmt_execute($stmt_update);
                mysqli_stmt_close($stmt_update);

                $success_message = "Your password has been successfully reset. You can now <a href='login.php'>login</a>.";
                // Clear session data to prevent issues.
                session_unset();
                session_destroy();
            } else {
                $error_message = "Passwords do not match.";
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
    <title>Reset Password</title>
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
            <h4 class="form-heading text-dark">Reset Password</h4>
            
            <?php if ($error_message) : ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <?php if ($success_message) : ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <?php if (!$error_message && !$success_message) : ?>
                <form action="reset_password.php?token=<?php echo $token; ?>" method="POST">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="********" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="********" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
