<?php
//include '../includes/database.php';
include '../includes/db_connect.php';
// Fetch vaccination records
$sql = "SELECT 
    p.id,
    p.full_name AS patient_name,
    p.age,
    p.gender,
    vs.vaccine_name,
    vs.status
FROM vaccination_status vs
JOIN patients p ON vs.patient_id = p.id
JOIN hospitals h ON vs.hospital_id = h.id
ORDER BY vs.date_given DESC
";
$result = $connect->query($sql);
if (!$result) {
    die("Query failed: " . $connect->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vaccination Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }

        .navbar-custom {
            background-color: #2BBBAD;
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: #fff;
        }

        .navbar-custom .nav-link:hover {
            color: #dff3ff;
        }

        .card-custom {
            background: #fff;
            border: 2px solid #2BBBAD;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #2BBBAD;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Hospital Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Update Vaccination Status</h2>

        <div class="card-custom">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Vaccine</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                <td><?= htmlspecialchars($row['age']) ?></td>
                                <td><?= htmlspecialchars($row['gender']) ?></td>
                                <td><?= htmlspecialchars($row['vaccine_name']) ?></td>
                                <td><?= htmlspecialchars($row['status']) ?></td>
                                <td>
                                    <a href="update_status_action.php?id=<?= $row['id'] ?>&status=vaccinated"
                                        class="btn btn-sm btn-custom">Mark Vaccinated</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>