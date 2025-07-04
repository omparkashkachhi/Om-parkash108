<?php
session_start();
include '../includes/db_connect.php'; // Database Connection

// User must be logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$adminName = 'Admin';

// If name already in session, use it
if (isset($_SESSION['name'])) {
    $adminName = htmlspecialchars($_SESSION['name']);
} else {
    // Get name from database
    $userId = $_SESSION['user_id'];
    $stmt = $connect->prepare("SELECT name FROM users WHERE id = ? AND role = 'admin' LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $adminName = htmlspecialchars($row['name']);
        $_SESSION['name'] = $row['name']; // Store in session
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | COVID Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/admin_css/admins_style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#patients">Patients</a></li>
                    <li class="nav-item"><a class="nav-link" href="#reports">Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="#vaccines">Vaccines</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hospitals">Hospital Approvals</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hospital-list">Hospitals</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bookings">Bookings</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="../logout.php"><i class="bi bi-box-arrow-right"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container text-center">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Admin Control Center</h1>
            <p class="fs-5 animate__animated animate__fadeIn">Manage hospitals, reports & vaccination effortlessly.</p>
            <p class="lead animate__animated animate__fadeInUp">Oversee appointments, stock updates & system health.</p>
            <div class="mt-4">
                <a href="#patients" class="btn btn-primary me-2">View Patients</a>
                <a href="#reports" class="btn btn-outline-light">Generate Reports</a>
            </div>
        </div>
    </section>

    <!-- Dashboard Sections -->
    <div class="container">
        <h2 class="my-4">Welcome, <?= $adminName ?></h2>

        <div id="patients" class="dashboard-card">
            <h5><i class="bi bi-person-lines-fill"></i> Patient Details</h5>
            <p><a href="patient_list.php" class="btn btn-outline-primary">View Patients</a></p>
        </div>

        <div id="reports" class="dashboard-card">
            <h5><i class="bi bi-clipboard-data"></i> COVID Test & Vaccination Reports</h5>
            <p><a href="reports.php" class="btn btn-outline-primary">Generate Reports</a></p>
        </div>

        <div id="vaccines" class="dashboard-card">
            <h5><i class="bi bi-capsule"></i> Vaccine List & Availability</h5>
            <p><a href="vaccine_list.php" class="btn btn-outline-primary">Manage Vaccines</a></p>
        </div>

        <div id="hospitals" class="dashboard-card">
            <h5><i class="bi bi-check-circle"></i> Approve Hospital Logins</h5>
            <p><a href="approve_hospitals.php" class="btn btn-outline-primary">Approval Requests</a></p>
        </div>

        <div id="hospital-list" class="dashboard-card">
            <h5><i class="bi bi-building"></i> Hospital List</h5>
            <p><a href="hospital_list.php" class="btn btn-outline-primary">View Hospitals</a></p>
        </div>

        <div id="bookings" class="dashboard-card">
            <h5><i class="bi bi-calendar-check"></i> Booking Details</h5>
            <p><a href="bookings.php" class="btn btn-outline-primary">View Bookings</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2025 CURE Portal. All rights reserved.</p>
            <p><a href="privcy.php">Privacy</a> | <a href="terms.php">Terms</a> | <a href="../contact.php">Contact</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>