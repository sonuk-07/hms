<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareFlow - Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold" href="#">CareFlow</a>
            <div class="ms-auto">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Admin User
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="sidebar bg-primary text-white fixed-top">
        <div class="pt-4">
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5">Dashboard</a>
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5 bg-primary-dark">Appointments</a>
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5">Medical Records</a>
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5">Payments</a>
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5">Doctors</a>
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5">Patients</a>
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5">Profile</a>
            <a href="#" class="d-block py-3 px-4 text-decoration-none text-white fs-5">Settings</a>
        </div>
    </div>

    <div class="content mt-5 ms-auto">
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 text-primary fw-bold">Appointments</h1>
            </div>

            <div class="mb-3 row g-3 align-items-center">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="searchAppointments"
                        placeholder="Search appointments...">
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="statusFilter">
                        <option value="all">All Statuses</option>
                        <option value="requested">Requested</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="checked_in">Checked In</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="no_show">No Show</option>
                    </select>
                </div>
                <div class="col-md-2 text-end">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white text-primary fw-bold">Upcoming Appointments</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Dr. Jane Smith</td>
                                    <td>General Practice</td>
                                    <td>2025-04-20</td>
                                    <td>9:00 AM</td>
                                    <td class="text-center"><span class="badge bg-success">Confirmed</span></td>
                                    <td>Annual checkup</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sarah Johnson</td>
                                    <td>Dr. Michael Brown</td>
                                    <td>Dermatology</td>
                                    <td>2025-04-21</td>
                                    <td>10:30 AM</td>
                                    <td class="text-center"><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td>Skin rash examination</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Robert Williams</td>
                                    <td>Dr. Emily Chen</td>
                                    <td>Neurology</td>
                                    <td>2025-04-22</td>
                                    <td>2:15 PM</td>
                                    <td class="text-center"><span class="badge bg-success">Confirmed</span></td>
                                    <td>Headache follow-up</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maria Garcia</td>
                                    <td>Dr. David Wilson</td>
                                    <td>Orthopedics</td>
                                    <td>2025-04-23</td>
                                    <td>11:00 AM</td>
                                    <td class="text-center"><span class="badge bg-success">Confirmed</span></td>
                                    <td>Wrist fracture follow-up</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>James Miller</td>
                                    <td>Dr. Jane Smith</td>
                                    <td>General Practice</td>
                                    <td>2025-04-24</td>
                                    <td>3:30 PM</td>
                                    <td class="text-center"><span class="badge bg-danger">Cancelled</span></td>
                                    <td>Prescription renewal</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary fw-bold">Today's Appointments</h5>
                            <p class="fs-3">2</p>
                            <small class="text-muted">Next: 2:00 PM with Dr. Smith</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-warning fw-bold">Pending Confirmations</h5>
                            <p class="fs-3">1</p>
                            <small class="text-muted">Waiting for doctor approval</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-info fw-bold">Total This Month</h5>
                            <p class="fs-3">8</p>
                            <small class="text-muted">3 completed, 5 upcoming</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary">New Appointment</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>