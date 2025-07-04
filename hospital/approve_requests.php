<?php

session_start();
include '../includes/db_connect.php';



// Handle approval/rejection
if (isset($_POST['action'], $_POST['appointment_id'])) {
    $appointmentId = intval($_POST['appointment_id']);
    $action = ($_POST['action'] === 'approve') ? 'Approved' : 'Rejected';

    $stmt = $connect->prepare("UPDATE appointments SET status = ? WHERE id = ? AND hospital_id = ?");
    $stmt->bind_param("sii", $action, $appointmentId, $hospitalId);
    $stmt->execute();
    $stmt->close();
}

/// Fetch pending appointments
$sql = "SELECT 
a.id AS appointment_id, 
p.full_name, 
p.age, 
p.gender, 
v.name AS vaccine_name, 
a.appointment_type, 
a.status 
FROM appointments a
JOIN patients p ON p.id = a.patient_id
JOIN vaccines v ON v.id = a.vaccine_id
WHERE a.hospital_id = ? 
AND (a.status = 'Pending' OR a.status = '')";

$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $hospitalId);
$stmt->execute();
$result = $stmt->get_result();

$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}
$stmt->close();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Appointment Requests | Hospital Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc #239e90;
            font-family: 'Poppins', sans-serif;
        }

        .header {
            background: linear-gradient(90deg, #0d6efd 70%, #2BBBAD 100%);
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 15px 15px;
        }

        .btn-approve {
            background-color: #2BBBAD;
            color: #fff;
            border: none;
        }

        .btn-approve:hover {
            background-color: #239e90;
        }

        .btn-reject {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-reject:hover {
            background-color: #b02a37;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Appointment Requests - Approve or Reject</h2>
    </div>

    <div class="container mt-4">
        <?php if (count($requests) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Vaccine</th>
                            <th>Appointment Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $req): ?>
                            <tr>
                                <td><?= $req['appointment_id'] ?></td>
                                <td><?= htmlspecialchars($req['full_name']) ?></td>
                                <td><?= htmlspecialchars($req['age']) ?></td>
                                <td><?= htmlspecialchars($req['gender']) ?></td>
                                <td><?= htmlspecialchars($req['vaccine_name']) ?></td>
                                <td><?= htmlspecialchars($req['appointment_type']) ?></td>
                                <td>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="appointment_id" value="<?= $req['appointment_id'] ?>">
                                        <button type="submit" name="action" value="approve"
                                            class="btn btn-approve btn-sm">Approve</button>
                                        <button type="submit" name="action" value="reject"
                                            class="btn btn-reject btn-sm ms-2">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center mt-4">No pending appointment requests.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>