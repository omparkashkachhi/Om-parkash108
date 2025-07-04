<?php
session_start();
include '../includes/db_connect.php';



$stmt = $connect->prepare("SELECT a.id, h.hospital_name, a.appointment_date, a.status 
FROM appointments a
JOIN hospitals h ON a.hospital_id = h.id
WHERE a.patient_id = ?
ORDER BY a.appointment_date DESC");

$stmt->bind_param("i", $patientId);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments | COVID Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/patient_css/patients_style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="patient_dashboard.php">Patient Portal</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="patient_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="my_appointments.php">My Appointments</a></li>
                    <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4 text-center">My Appointments</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="table-responsive dashboard-card">
                <table class="table table-striped table-hover">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Hospital</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($row['hospital_name']) ?></td>
                                <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                                <td>
                                    <?php
                                    $status = $row['status'];
                                    $badgeClass = $status === 'Approved' ? 'bg-success' : ($status === 'Pending' ? 'bg-warning text-dark' : 'bg-danger');
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info dashboard-card">You have no appointments yet.</div>
        <?php endif; ?>
    </div>

    <footer class="text-center mt-5">
        <div class="container">
            <p>&copy; 2025 CURE Portal. All rights reserved.</p>
            <p><a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">Contact</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>