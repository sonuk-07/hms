<?php
    session_start();
    include '../Includes/dbConnection.php';
    if(!isset($_SESSION['user_id'])){
        echo "you are not logged in";
        exit();
    }

    $name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CareFlow Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar d-flex flex-column p-3">
        <h4 class="mb-4">CareFlow</h4>
        <a href="#" class="active">Dashboard</a>
        <a href="#">Appointments</a>
        <a href="#">Medical Records</a>
        <a href="#">Payments</a>
        <a href="#">Doctors</a>
        <a href="#">Patients</a>
        <a href="#">Profile</a>
        <a href="#">Settings</a>
        <div class="mt-auto text-white-50 small pt-4">Logged in as: admin</div>
      </div>

      <!-- Main content -->
      <div class="col-md-10 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h2>Admin Dashboard</h2>
            <p class="text-muted">Overview of hospital operations and statistics</p>
          </div>
          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <span class="me-2">🟢</span>
              <?php
              echo $name;
              ?>
            </button>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-3 mb-4 card-stats">
          <div class="col-md-3">
            <div class="card p-3">
              <div class="text-muted">Total Patients</div>
              <h4>1,234</h4>
              <small class="text-success">+20.1% from last month</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3">
              <div class="text-muted">Total Doctors</div>
              <h4>42</h4>
              <small class="text-success">+20.1% from last month</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3">
              <div class="text-muted">Appointments Today</div>
              <h4>57</h4>
              <small class="text-success">+20.1% from last month</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3">
              <div class="text-muted">Revenue This Month</div>
              <h4>$12,345</h4>
              <small class="text-success">+20.1% from last month</small>
            </div>
          </div>
        </div>

        <!-- Recent Appointments -->
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-0">Recent Appointments</h5>
              <small class="text-muted">Overview of the latest appointments</small>
            </div>
            <button class="btn btn-outline-primary btn-sm">View All →</button>
          </div>
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Patient</th>
                  <th>Doctor</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>John Doe</td>
                  <td>Dr. Jane Smith</td>
                  <td>2025-04-16</td>
                  <td>10:00 AM</td>
                  <td><span class="badge-status completed">Completed</span></td>
                </tr>
                <tr>
                  <td>Sarah Johnson</td>
                  <td>Dr. Robert Lee</td>
                  <td>2025-04-16</td>
                  <td>11:30 AM</td>
                  <td><span class="badge-status pending">Pending</span></td>
                </tr>
                <tr>
                  <td>Michael Brown</td>
                  <td>Dr. Emily Chen</td>
                  <td>2025-04-17</td>
                  <td>09:15 AM</td>
                  <td><span class="badge-status confirmed">Confirmed</span></td>
                </tr>
                <tr>
                  <td>Jessica Davis</td>
                  <td>Dr. William Patel</td>
                  <td>2025-04-17</td>
                  <td>02:45 PM</td>
                  <td><span class="badge-status pending">Pending</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Actions -->
        <div class="row g-3">
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h6>Add New Patient</h6>
              <p class="text-muted small">Register a new patient in the system</p>
              <button class="btn btn-primary">Add Patient</button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h6>Schedule Appointment</h6>
              <p class="text-muted small">Create a new appointment slot</p>
              <button class="btn btn-primary">Create Appointment</button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h6>Generate Reports</h6>
              <p class="text-muted small">Create system-wide reports</p>
              <button class="btn btn-primary">View Reports</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
