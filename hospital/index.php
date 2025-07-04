<?php


session_start();
include '../includes/db_connect.php'; // Adjust path if needed

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'hospital') {
    header("Location: ../index.php");
    exit();
}

$hospitalName = 'Guest';

// Check if user is logged in and role is patient
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'hospital') {

    // If name is already stored in session, use it
    if (isset($_SESSION['name'])) {
        $hospitalName = htmlspecialchars($_SESSION['name']);
    } else {
        // Fetch name from database using user_id
        $userId = $_SESSION['user_id'];
        $query = "SELECT name FROM users WHERE id = $userId AND role = 'hospital' LIMIT 1";
        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hospitalName = htmlspecialchars($row['name']);
            $_SESSION['name'] = $row['name']; // Store it for future use
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard | COVID Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../assets/hospital_css/hospital_style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-4 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Hospital Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#patient-list">Patient Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#requests">Patient Requests</a></li>
                    <li class="nav-item"><a class="nav-link" href="#test-result">Test Results</a></li>
                    <li class="nav-item"><a class="nav-link" href="#vaccine-status">Vaccination</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="../logout.php"><i class="bi bi-box-arrow-right"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container text-center">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Your Health, Our Responsibility</h1>
            <p class="fs-5 animate__animated animate__fadeIn">Manage patients and vaccination with ease.</p>
            <p class="lead animate__animated animate__fadeInUp">Stay organized. Update results. Track vaccination
                status.</p>
            <div class="mt-4">
                <a href="#patient-list" class="btn btn-primary me-2">View Patients</a>
                <a href="#requests" class="btn btn-outline-light">Manage Requests</a>
            </div>
        </div>
    </section>

    <div class="container">
        <h2 class="my-4">Welcome, <?= $hospitalName ?></h2>



        <div id="patient-list" class="dashboard-card">
            <h5><i class="bi bi-people"></i> Patient Details</h5>
            <p><a href="patient-list.php" class="btn btn-outline-success">View Patients</a></p>
        </div>

        <div id="requests" class="dashboard-card">
            <h5><i class="bi bi-envelope"></i> Patient Requests</h5>
            <p><a href="approve_requests.php" class="btn btn-outline-success">Approve or Reject Requests</a></p>
        </div>

        <div id="test-result" class="dashboard-card">
            <h5><i class="bi bi-clipboard-check"></i> Update Test Result</h5>
            <p><a href="update_result_form.php" class="btn btn-outline-success">Enter or Update COVID Test Results</a>
            </p>
        </div>

        <div id="vaccine-status" class="dashboard-card">
            <h5><i class="bi bi-shield-check"></i> Update Vaccination Status</h5>
            <p><a href="update_vaccination_status.php" class="btn btn-outline-success">Update Vaccines</a></p>
        </div>
    </div>

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