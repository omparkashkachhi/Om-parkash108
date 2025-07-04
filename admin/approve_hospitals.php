<?php
// Database Connection
include '../includes/db_connect.php';
session_start();

// Handle Approve or Reject actions
if (isset($_POST['action']) && isset($_POST['hospital_id'])) {
    $hospital_id = (int) $_POST['hospital_id'];
    $status = ($_POST['action'] === 'approve') ? 1 : 0;

    $stmt = $connect->prepare("UPDATE hospitals SET approved = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $hospital_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch Hospital Requests
$result = $connect->query("SELECT * FROM hospitals WHERE approved = 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Approve Hospital Logins | Admin Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #222;
    }

    .dashboard-card {
        background: #fff;
        color: #000;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        padding: 20px;
        margin: 20px 0;
    }

    .btn-primary {
        background-color: #2BBBAD;
        border: none;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }

    table th {
        background-color: #2BBBAD;
        color: #fff;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Approve Hospital Login Requests</h2>

        <div class="dashboard-card">
            <?php if ($result && $result->num_rows > 0): ?>
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hospital Name</th>
                        <th>Location</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($hospital = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $hospital['id'] ?></td>
                        <td><?= htmlspecialchars($hospital['hospital_name']) ?></td>
                        <td><?= htmlspecialchars($hospital['location']) ?></td>
                        <td><?= htmlspecialchars($hospital['email']) ?></td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="hospital_id" value="<?= $hospital['id'] ?>">
                                <button type="submit" name="action" value="approve" class="btn btn-primary btn-sm">
                                    <i class="bi bi-check-circle"></i> Approve
                                </button>
                            </form>
                            <form method="POST" class="d-inline ms-2">
                                <input type="hidden" name="hospital_id" value="<?= $hospital['id'] ?>">
                                <button type="submit" name="action" value="reject"
                                    class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p class="text-center">No pending hospital login requests.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>