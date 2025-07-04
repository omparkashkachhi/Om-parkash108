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
    <title>Terms & Conditions - Admin Panel</title>
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

        .terms-container {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-width: 900px;
            margin: 3rem auto;
            animation: fadeIn 0.8s;
        }

        .terms-container h2 {
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
        <div class="terms-container">
            <h2>Admin Terms & Conditions</h2>
            <p>Welcome to the Admin Panel of the COVID Vaccination System. By accessing this panel, you agree to the
                following terms:</p>

            <ul>
                <li>You must maintain the confidentiality of all system data.</li>
                <li>System features are to be used strictly for administrative purposes only.</li>
                <li>You are responsible for verifying information before making decisions.</li>
                <li>Data manipulation, deletion, or sharing without proper authorization is prohibited.</li>
                <li>All system activity is monitored to ensure security and compliance.</li>
                <li>Violations of these terms may result in suspension of access and legal action.</li>
            </ul>

            <p>By continuing to use the Admin Panel, you confirm that you have read, understood, and agreed to these
                terms.</p>

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