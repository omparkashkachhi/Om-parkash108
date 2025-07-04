<?php
session_start();
include '../includes/db_connect.php';

// User Authentication Check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: ../index.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Handle Appointment Cancellation with Prepared Statement
if (isset($_GET['cancel'])) {
    $id = (int) $_GET['cancel'];

    $stmt = $connect->prepare("DELETE FROM appointments WHERE id = ? AND patient_id = ?");
    $stmt->bind_param("ii", $id, $userId);
    $stmt->execute();
    $stmt->close();
}

// Fetch Appointments with Hospital Names
$stmt = $connect->prepare("
    SELECT a.*, h.hospital_name 
    FROM appointments a
    JOIN hospitals h ON a.hospital_id = h.id
    WHERE a.patient_id = ?
    ORDER BY a.appointment_date DESC
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Appointments - Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #2BBBAD 60%, #6ea8fe 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .appointments-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(13, 110, 253, 0.2);
            padding: 2rem;
            margin: 3rem auto;
            max-width: 900px;
        }

        h2 {
            color: #2BBBAD;
            text-align: center;
        }

        .table th {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-theme {
            background: linear-gradient(90deg, #0d6efd 70%, #2BBBAD 100%);
            color: #fff;
            border: none;
        }

        .btn-theme:hover {
            background: linear-gradient(90deg, #2BBBAD 70%, #0d6efd 100%);
        }
    </style>
</head>

<body>
    <div class="appointments-container">
        <h2 class="mb-4">My Appointments</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Hospital</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Test Result</th>
                        <th>Vaccination Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['hospital_name']) ?></td>
                            <td><?= htmlspecialchars($row['appointment_type']) ?></td>
                            <td><?= $row['appointment_date'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td><?= $row['test_result'] ?? 'N/A' ?></td>
                            <td><?= $row['vaccination_status'] ?? 'N/A' ?></td>
                            <td>
                                <?php if ($row['status'] == 'Pending'): ?>
                                    <a href="?cancel=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to cancel this appointment?');">
                                        Cancel
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">
                No Appointments Found.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php $stmt->close(); ?>