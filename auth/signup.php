<?php
include '../Includes/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username']; // Get the username from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = $_POST['role'];

    if ($password === $confirmPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into users table
        $sql = "INSERT INTO users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, ?)"; // Added 'username' to the query
        $stmt = mysqli_prepare($dbconn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $full_name, $username, $email, $hashedPassword, $role); // Bind the username

        if (mysqli_stmt_execute($stmt)) {
            $user_id = mysqli_insert_id($dbconn);

            // ... (rest of your code for inserting into role-specific tables remains the same) ...

            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($dbconn);
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CareFlow Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden { display: none; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="text-primary">CareFlow</h2>
            <p class="text-secondary">Hospital Management System</p>
        </div>

        <div class="register-form-box mx-auto shadow p-4 bg-white rounded-4" style="max-width: 600px;">
            <h4 class="mb-3">Create an Account</h4>
            <form action="signup.php" method="POST" id="signup-form">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="full_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Role</label>
                    <select name="role" class="form-select" id="role" required>
                        <option value="">--Select Role--</option>
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="patient">Patient</option>
                        <option value="reception">Reception</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>

    <script>
        const roleSelector = document.getElementById("role");
        const doctorFields = document.getElementById("doctor-fields");
        const patientFields = document.getElementById("patient-fields");
        const receptionistFields = document.getElementById("receptionist-fields");

        roleSelector.addEventListener("change", function () {
            const role = this.value;
            doctorFields.classList.add("hidden");
            patientFields.classList.add("hidden");
            receptionistFields.classList.add("hidden");

            if (role === "doctor") doctorFields.classList.remove("hidden");
            else if (role === "patient") patientFields.classList.remove("hidden");
            else if (role === "reception") receptionistFields.classList.remove("hidden");
        });
    </script>
</body>
</html>