<?php
session_start();
include '../includes/db_connect.php';

// Check if logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Privacy Policy - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #2BBBAD);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .privacy-container {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-width: 900px;
            margin: 3rem auto;
            animation: fadeIn 0.8s;
        }

        .privacy-container h2 {
            color: #0d6efd;
            margin-bottom: 1rem;
            text-align: center;
        }

        footer {
            margin-top: auto;
            background: #fff;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="privacy-container">
            <h2>Admin Privacy Policy</h2>
            <p>As an Admin, you are entrusted with managing sensitive data within the Vaccination System. Please be
                aware of the following:</p>

            <ul>
                <li>You have access to patient, hospital, and vaccination data for system management purposes only.</li>
                <li>All data must be handled responsibly and confidentially.</li>
                <li>You are prohibited from sharing or distributing system data outside authorized channels.</li>
                <li>Your admin activities are logged for security and accountability purposes.</li>
                <li>Security measures are in place to protect data integrity and prevent unauthorized access.</li>
            </ul>

            <p>By using the Admin Panel, you agree to adhere to these privacy standards. Any misuse of data or system
                privileges may result in access termination and legal consequences.</p>

            <div class="mt-4 text-center">
                <a href="index.php" class="btn btn-primary">Back to Admin Dashboard</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            &copy; 2025 COVID Vaccination System. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>