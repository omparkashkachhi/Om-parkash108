<?php
session_start();
include '../includes/db_connect.php';

// Check if logged in as patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Terms & Conditions - Patient Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2BBBAD, #6ea8fe);
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
            <h2>Terms & Conditions</h2>
            <p>Welcome to the Patient Portal of the COVID Vaccination System. By accessing and using this portal, you
                agree to comply with the following terms:</p>

            <ul>
                <li>You are responsible for providing accurate and truthful information during registration and profile
                    updates.</li>
                <li>You must not share your login credentials with others.</li>
                <li>Booking of appointments is subject to hospital availability and approval.</li>
                <li>All information provided is confidential and handled according to our privacy policy.</li>
                <li>Any misuse of the system may result in account suspension.</li>
            </ul>

            <p>We reserve the right to update these terms at any time. Continued use of the portal signifies your
                acceptance of any changes.</p>

            <div class="mt-4 text-center">
                <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
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