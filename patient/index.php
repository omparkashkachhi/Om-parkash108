<?php
session_start();
include '../includes/db_connect.php'; // Database connection

// Check if user is logged in and role is patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: ../index.php");
    exit();
}

$patientName = 'Guest';

// Fetch name securely from database only if not in session
if (isset($_SESSION['name'])) {
    $patientName = htmlspecialchars($_SESSION['name']);
} else {
    $userId = $_SESSION['user_id'];
    $stmt = $connect->prepare("SELECT name FROM users WHERE id = ? AND role = 'patient' LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $patientName = htmlspecialchars($row['name']);
        $_SESSION['name'] = $row['name']; // Store for future use
    }
    $stmt->close();
}

// Fetch approved hospitals
$hospitalResult = $connect->query("SELECT hospital_name, location FROM hospitals WHERE approved = 1");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard | COVID Portal</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/patient_css/patients_style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Patient Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#search">Search Hospitals</a></li>
                    <li class="nav-item"><a class="nav-link" href="#request">Request Test/Vaccine</a></li>
                    <li class="nav-item"><a class="nav-link" href="#report">Vaccine Report</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="appointmentDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Appointments
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#book">Book Appointment</a></li>
                            <li><a class="dropdown-item" href="#appointment">My Appointment</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#results">View Results</a></li>
                    <li class="nav-item"><a class="nav-link" href="#profile">My Profile</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Get the Vaccine, Protect Your Health
            </h1>
            <p class="fs-5 animate__animated animate__fadeIn">Welcome to your patient dashboard.</p>
            </h1>
            <p class="lead animate__animated animate__fadeInUp">Book your COVID-19 test and vaccination appointment now.
            </p>
            <div class="mt-4">
                <a href="#register" class="btn btn-primary me-2">Book Appointment</a>
                <a href="#learn" class="btn btn-outline-primary">Learn More</a>
            </div>
        </div>
    </section>

    <main class="container mt-4">
        <h2 class="my-4">Welcome, <?= $patientName ?></h2>

        <div id="search" class="dashboard-card">
            <h5><i class="bi bi-search"></i> Search Hospitals</h5>
            <input type="text" id="hospitalSearchInput" class="form-control mb-3"
                placeholder="Search hospitals by name or location...">
            <ul class="list-group" id="hospitalList">
                <?php if ($hospitalResult && $hospitalResult->num_rows > 0): ?>
                    <?php while ($hospital = $hospitalResult->fetch_assoc()): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center hospital-item">
                            <span class="hospital-name"><?= htmlspecialchars($hospital['hospital_name']) ?></span>
                            <span
                                class="badge bg-success hospital-location"><?= htmlspecialchars($hospital['location']) ?></span>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="list-group-item">No hospitals available.</li>
                <?php endif; ?>
            </ul>
        </div>

        <div id="request" class="dashboard-card">
            <h5><i class="bi bi-send"></i> Request for Test/Vaccination</h5>
            <a href="request_form.php" class="btn btn-outline-primary">Make a Request</a>
        </div>

        <div id="report" class="dashboard-card">
            <h5><i class="bi bi-file-earmark-text"></i> Test/Vaccine Report</h5>
            <a href="report.php" class="btn btn-outline-primary">View Report</a>
        </div>

        <div id="book" class="dashboard-card">
            <h5><i class="bi bi-calendar-plus"></i> Book Appointment</h5>
            <a href="book_appointment.php" class="btn btn-outline-primary">Book Now</a>
        </div>

        <div id="appointment" class="dashboard-card">
            <h5><i class="bi bi-clock-history"></i> My Appointments</h5>
            <a href="my_appointments.php" class="btn btn-outline-primary">View Appointments</a>
        </div>

        <div id="results" class="dashboard-card">
            <h5><i class="bi bi-clipboard-check"></i> View Results</h5>
            <a href="results.php" class="btn btn-outline-primary">Check Results</a>
        </div>

        <div id="profile" class="dashboard-card">
            <h5><i class="bi bi-person-circle"></i> My Profile</h5>
            <a href="profile.php" class="btn btn-outline-primary">Manage Profile</a>
        </div>
    </main>

    <footer class="text-center">
        <div class="container">
            <p>&copy; 2025 CURE Portal. All rights reserved.</p>
            <p><a href="privcy.php">Privacy</a> | <a href="terms.php">Terms</a> | <a href="../contact.php">Contact</a>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../logout.php"><i class="bi bi-box-arrow-right"></i>
                        Logout</a>
                </li>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/hospital_search.js"></script>
</body>

</html>