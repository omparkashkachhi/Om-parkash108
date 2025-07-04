<?php
session_start();
include '../includes/db_connect.php';

// Hospital login check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'hospital') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Privacy Policy - Hospital Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2BBBAD, #6ea8fe);
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
            color: #2BBBAD;
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
            <h2>Hospital Privacy Policy</h2>
            <p>Your privacy is important to us. This policy explains how your hospital's data is collected, used, and
                protected:</p>

            <ul>
                <li>We collect and store hospital details strictly for system functionality and patient appointment
                    management.</li>
                <li>Your login credentials are securely stored and never shared with third parties.</li>
                <li>Patient information obtained via the system must be handled in accordance with privacy regulations.
                </li>
                <li>We implement appropriate security measures to protect data from unauthorized access or misuse.</li>
                <li>We do not share your hospital's data with external parties without your consent, unless required by
                    law.</li>
                <li>By using this portal, you agree to the terms of this Privacy Policy.</li>
            </ul>

            <div class="mt-4 text-center">
                <a href="index.php" class="btn btn-primary">Back to Hospital Dashboard</a>
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