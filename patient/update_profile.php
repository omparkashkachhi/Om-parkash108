<?php
session_start();
include '../includes/db_connect.php';

// Assuming user ID is stored in session after login
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch patient details
$sql = "SELECT * FROM patients WHERE user_id = $user_id";
$result = $connect->query($sql);

if ($result->num_rows !== 1) {
    echo "<p class='text-center mt-5'>Patient record not found.</p>";
    exit();
}

$patient = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-custom {
            background-color: #0d6efd;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #fff;
        }

        .navbar-custom .nav-link:hover {
            color: #dff3ff;
        }

        .card-custom {
            background: #fff;
            border: 2px solid #2BBBAD;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
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
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Patient Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <div class="card-custom">
            <h3 class="mb-4">Update Your Profile</h3>
            <form action="update_profile.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control"
                        value="<?= htmlspecialchars($patient['full_name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male" <?= $patient['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $patient['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control"
                        value="<?= htmlspecialchars($patient['age']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control"
                        value="<?= htmlspecialchars($patient['phone']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control"
                        value="<?= htmlspecialchars($patient['address']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control"
                        value="<?= htmlspecialchars($patient['location']) ?>">
                </div>
                <button type="submit" class="btn btn-custom">Update Profile</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>