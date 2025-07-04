<?php
include 'db_connect.php'; // Database connection



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - Vaccination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #2BBBAD 60%, #6ea8fe 100%);
            min-height: 100vh;
        }

        .register-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(13, 110, 253, 0.2);
            padding: 2rem 2.5rem;
            max-width: 420px;
            margin: 3rem auto;
        }

        .form-label {
            color: #0d6efd;
            font-weight: 500;
        }

        .btn-theme {
            background: linear-gradient(90deg, #0d6efd 70%, #2BBBAD 100%);
            color: #fff;
            border: none;
        }

        .btn-theme:hover {
            background: linear-gradient(90deg, #2BBBAD 70%, #0d6efd 100%);
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #2BBBAD;
            box-shadow: 0 0 0 0.2rem rgba(43, 187, 173, .25);
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2 class="mb-4 text-center" style="color:#2BBBAD;">Register</h2>
        <form action="process_register.php" method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name / Hospital Name</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="100">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required maxlength="100">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required
                    minlength="6">
            </div>
            <div class="mb-4">
                <label for="role" class="form-label">Register As</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled selected>Select role</option>
                    <option value="admin">Admin</option>
                    <option value="hospital">Hospital</option>
                    <option value="patient">Patient</option>
                </select>
            </div>
            <button type="submit" class="btn btn-theme w-100">Register</button>
        </form>
        <p class="mt-3 text-center">
            Already have an account? <a href="login.php" style="color:#0d6efd;">Login</a>
        </p>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>