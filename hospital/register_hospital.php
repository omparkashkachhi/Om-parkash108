<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO hospitals (name, location, phone, approved) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("sss", $name, $location, $phone);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Hospital Registered. Waiting for Admin Approval.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<!-- Add Bootstrap CSS for responsiveness -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Register Hospital</h4>
                </div>
                <div class="card-body">
                    <form method="POST" autocomplete="off">
                        <div class="mb-3">
                            <label for="name" class="form-label">Hospital Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Hospital Name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register Hospital</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>