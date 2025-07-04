<?php
include '../includes/db_connect.php';
session_start();

// Admin check
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Fetch hospitals
$query = "SELECT hospitals.*, users.status FROM hospitals 
          JOIN users ON hospitals.user_id = users.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Hospitals</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Manage Hospital Accounts</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Hospital Name</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['hospital_name'] ?></td>
                        <td><?= $row['location'] ?></td>
                        <td><?= $row['contact'] ?></td>
                        <td><span
                                class="badge bg-<?= $row['status'] === 'approved' ? 'success' : ($row['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                <?= ucfirst($row['status']) ?></span></td>
                        <td>
                            <?php if ($row['status'] !== 'approved') { ?>
                                <a href="approve_hospital.php?id=<?= $row['user_id'] ?>"
                                    class="btn btn-success btn-sm">Approve</a>
                            <?php } ?>
                            <?php if ($row['status'] !== 'rejected') { ?>
                                <a href="reject_hospital.php?id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>