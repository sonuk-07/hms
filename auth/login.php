<?php 
session_start();
include '../Includes/dbConnection.php';
if($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Prepared statement to prevent SQL injection
  $sql_user = "SELECT * FROM users WHERE email = ?";
  $stmt = mysqli_prepare($dbconn, $sql_user);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt); // Fetch result from prepared statement
  $user_data = mysqli_fetch_assoc($result);

  // Check if user exists and verify password
  if($user_data && password_verify($password, $user_data['password'])) {
    // Set session variables
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] =  $user_data['id'];
    $_SESSION['name'] = $user_data['name'];
    $_SESSION['user_role'] = $user_data['role'];
    $_SESSION['user_email'] = $email;

    // Redirect to the appropriate dashboard based on user role
    header("Location: ../{$_SESSION['user_role']}/{$_SESSION['user_role']}_dashboard.php");
    exit();
  } else {
    echo "Error: Invalid credentials, try again!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareFlow Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-light">
  <div class="container text-center mt-5">
    <h2 class="text-primary">CareFlow</h2>
    <p class="mb-4 text-secondary">Hospital Management System</p>
  </div>

  <div class="container">
    <div class="login-form-box mx-auto shadow p-4 bg-white rounded-4">
      <h4 class="form-heading text-dark">Login</h4>
      <p class="form-subtext text-muted">Enter your credentials to access your account</p>
      <form action="login.php" method="POST">
        <div class="mb-3">
          <label for="login-email" class="form-label">Email</label>
          <input type="email" class="form-control" id="login-email" name="email" placeholder="email@example.com">
        </div>
        <div class="mb-3">
          <label for="login-password" class="form-label">Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="********">
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign In</button>
      </form>

      <div class="demo-info text-center mt-3">
        <p class="mb-1 text-muted">Demo accounts (password: password):</p>
        <div class="d-flex justify-content-center gap-2">
          <button class="btn btn-outline-primary btn-sm">Admin</button>
          <button class="btn btn-outline-primary btn-sm">Doctor</button>
          <button class="btn btn-outline-primary btn-sm">Patient</button>
        </div>
      </div>
      <p class="mt-3 text-center">Don't have an account? <a href="signup.php" class="link-primary">Register</a></p>
    </div>
  </div>
</body>
</html>