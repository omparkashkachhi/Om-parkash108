<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$connect = new mysqli("localhost", "root", "", "vaccination_system");
if ($connect->connect_error)
    die("Connection failed: " . $connect->connect_error);

// Get total stats
$patients = $connect->query("SELECT COUNT(*) AS total FROM patient")->fetch_assoc()['total'];
$vaccines = $connect->query("SELECT COUNT(*) AS total FROM vaccine_stock")->fetch_assoc()['total'];
$appointments = $connect->query("SELECT COUNT(*) AS total FROM appointment")->fetch_assoc()['total'];
$hospitals = $connect->query("SELECT COUNT(*) AS total FROM hospital")->fetch_assoc()['total'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard - Vaccination Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hospital Admin</a>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Welcome, <?= $_SESSION['admin']['name'] ?></h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Patients</h5>
                        <p class="card-text fs-3"><?= $patients ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">Vaccines Available</h5>
                        <p class="card-text fs-3"><?= $vaccines ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body">
                        <h5 class="card-title">Appointments</h5>
                        <p class="card-text fs-3"><?= $appointments ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-info shadow">
                    <div class="card-body">
                        <h5 class="card-title">Registered Hospitals</h5>
                        <p class="card-text fs-3"><?= $hospitals ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-secondary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Medical Staff</h5>
                        <p class="card-text fs-3"><?= $staff ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php $conn->close(); ?>