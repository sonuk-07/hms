<?php 
include '../Includes/dbConnection.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $name = $_POST['full_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];
  $role = $_POST['role'];
  if($password == $confirmPassword){
    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name,email,password,role) VALUES(?,?,?,?)";
    $stmt = mysqli_prepare($dbconn,$sql);
    mysqli_stmt_bind_param($stmt,"ssss",$name,$email,$hashedPassword,$role);

    if(mysqli_stmt_execute($stmt)){
      header("Location:login.php");
      exit();
    }else{
      echo "Error: ".mysqli_error($dbconn);
    }
  }else{
    echo "Passwords donot match!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareFlow Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-light">
  <div class="container text-center mt-5">
    <h2 class="text-primary">CareFlow</h2>
    <p class="mb-4 text-secondary">Hospital Management System</p>
  </div>

  <div class="container">
    <div class="register-form-box mx-auto shadow p-4 bg-white rounded-4">
      <h4 class="form-heading text-dark">Create an Account</h4>
      <p class="form-subtext text-muted">Register to access our hospital management system</p>
      <form action="signup.php" method="POST">
        <div class="mb-3">
          <label for="full-name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="full-name" name="full_name" placeholder="John Doe">
        </div>
        <div class="mb-3">
          <label for="register-email" class="form-label">Email</label>
          <input type="email" class="form-control" id="register-email" name="email" placeholder="email@example.com">
        </div>
        <div class="mb-3">
          <label for="register-password" class="form-label">Password</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="********">
        </div>
        <div class="mb-3">
          <label for="confirm-password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="********">
        </div>
        <div class="mb-3">
          <label class="form-label">Select your role</label>
          <div class="btn-group w-100" role="group">
            <input type="radio" class="btn-check" name="role" id="role-admin" value="admin" autocomplete="off">
            <label class="btn btn-outline-secondary" for="role-admin">Admin</label>

            <input type="radio" class="btn-check" name="role" id="role-doctor" value="doctor" autocomplete="off">
            <label class="btn btn-outline-secondary" for="role-doctor">Doctor</label>

            <input type="radio" class="btn-check" name="role" id="role-patient" value="patient" autocomplete="off">
            <label class="btn btn-outline-secondary" for="role-patient">Patient</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
      <p class="mt-3 text-center">Already have an account? <a href="login.php" class="link-primary">Login</a></p>
    </div>
  </div>
</body>
</html>