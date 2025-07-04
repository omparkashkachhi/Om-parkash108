<?php
session_start();
include '../includes/db_connect.php';

// Check login and role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: ../index.php");
    exit();
}

$patientData = [];
$success = '';
$error = '';

$userId = $_SESSION['user_id'];

// Fetch patient details
$stmt = $connect->prepare("SELECT full_name, age, gender, phone, address, location FROM patients WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows === 1) {
    $patientData = $result->fetch_assoc();
} else {
    $error = "Profile not found!";
}
$stmt->close();

// Handle Profile Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($connect, $_POST['full_name']);
    $age = (int) $_POST['age'];
    $gender = mysqli_real_escape_string($connect, $_POST['gender']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);

    $update = $connect->prepare("UPDATE patients SET full_name=?, age=?, gender=?, phone=?, address=?, location=? WHERE user_id=?");
    $update->bind_param("sissssi", $name, $age, $gender, $phone, $address, $location, $userId);

    if ($update->execute()) {
        $success = "Profile updated successfully.";

        // Update displayed data immediately
        $patientData['full_name'] = $name;
        $patientData['age'] = $age;
        $patientData['gender'] = $gender;
        $patientData['phone'] = $phone;
        $patientData['address'] = $address;
        $patientData['location'] = $location;

    } else {
        $error = "Failed to update profile.";
    }
    $update->close();
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>My Profile - Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .btn-theme {
            background: #2BBBAD;
            color: #fff;
        }

        .btn-theme:hover {
            background: #0d6efd;
        }
    </style>
</head>

<body>

    <div class="container profile-container">
        <h2 class="mb-4 text-center">My Profile</h2>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($patientData): ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" required
                        value="<?= htmlspecialchars($patientData['full_name']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" required value="<?= (int) $patientData['age'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male" <?= $patientData['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $patientData['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= $patientData['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" required
                        value="<?= htmlspecialchars($patientData['phone']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" required
                        value="<?= htmlspecialchars($patientData['address']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" required
                        value="<?= htmlspecialchars($patientData['location']) ?>">
                </div>
                <button type="submit" class="btn btn-theme w-100">Update Profile</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>