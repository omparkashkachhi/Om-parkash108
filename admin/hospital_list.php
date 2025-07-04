<?php
// Database Connection
include '../includes/db_connect.php';

// Fetch Hospitals
$query = "SELECT id, user_id, hospital_name, address, location, contact, approved, email FROM hospitals";
$result = $connect->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hospital List | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/admin_css/admin_style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-teal" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-teal" href="admin_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-teal" href="hospital_list.php">Hospital List</a></li>
                    <li class="nav-item"><a class="nav-link text-teal" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container mt-5">
        <h2 class="mb-4">Registered Hospitals</h2>

        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-teal text-white">
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Hospital Name</th>
                        <th>Address</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Approved</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($hospital = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($hospital['id']) ?></td>
                        <td><?= htmlspecialchars($hospital['user_id']) ?></td>
                        <td><?= htmlspecialchars($hospital['hospital_name']) ?></td>
                        <td><?= htmlspecialchars($hospital['address']) ?></td>
                        <td><?= htmlspecialchars($hospital['location']) ?></td>
                        <td><?= htmlspecialchars($hospital['contact']) ?></td>
                        <td><?= htmlspecialchars($hospital['email']) ?></td>
                        <td>
                            <?php if ($hospital['approved']): ?>
                            <span class="badge bg-success">Approved</span>
                            <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No hospitals found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer class="text-center mt-5 text-teal">
        <div class="container">
            <p>&copy; 2025 CURE Portal. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>