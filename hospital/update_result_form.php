<?php
// Assume session & database connection are already included in your project structure
include '../includes/db_connect.php';


// // Fetch patient appointments for test result update (assuming appointments table links patients ↔ hospitals)
// $hospital_email = $_SESSION['users']; // Assuming hospital logs in via email
$query = "SELECT a.id AS appointment_id, t.result 
FROM appointments a 
JOIN test_results t ON a.id = t.appointment_id 
WHERE a.patient_id = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Test Results | Hospital Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        background: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .header {
        background: #0d6efd;
        color: #fff;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
    }

    .table thead {
        background: #2BBBAD;
        color: #fff;
    }

    .btn-update {
        background: #2BBBAD;
        color: #fff;
    }

    .btn-update:hover {
        background: #0d6efd;
    }
    </style>
</head>

<body>

    <div class="header">
        <h2>Update COVID Test Results</h2>
    </div>

    <div class="container">
        <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Appointment Type</th>
                        <th>Test Result</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                        while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['test_results'] ?: 'Pending'); ?></td>
                        <td>
                            <a href="update_result_form.php?id=<?php echo $row['appointment_id']; ?>"
                                class="btn btn-update btn-sm">Update</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-info">No appointments found for your hospital.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>