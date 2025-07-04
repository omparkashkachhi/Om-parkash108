<?php
// Database Connection
include 'includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs | COVID Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/admin_css/admin_style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            color: #222;
        }

        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            color: #2BBBAD !important;
            font-weight: 600;
        }

        .faq-card {
            background: #fff;
            color: #000;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 20px 0;
        }

        footer {
            background: #2BBBAD;
            color: #fff;
            padding: 20px 0;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">COVID Admin Portal</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="faq.php">FAQs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4 text-center">Frequently Asked Questions</h2>

        <div class="faq-card">
            <h5><i class="bi bi-question-circle"></i> How do I approve hospital login requests?</h5>
            <p>Navigate to the "Approve Hospital Login" section on the Admin Dashboard. You can approve or reject
                pending hospital requests from there.</p>
        </div>

        <div class="faq-card">
            <h5><i class="bi bi-question-circle"></i> How can I update vaccine availability?</h5>
            <p>Go to the "Vaccine List & Availability" page. You can update stock and availability status for each
                vaccine listed.</p>
        </div>

        <div class="faq-card">
            <h5><i class="bi bi-question-circle"></i> Can I generate test and vaccination reports?</h5>
            <p>Yes, visit the "Reports" section where you can view data charts and export reports to Excel for further
                analysis.</p>
        </div>

        <div class="faq-card">
            <h5><i class="bi bi-question-circle"></i> How do I reset a hospital's password?</h5>
            <p>Currently, hospital users need to reset their passwords through the hospital portal. You can assist by
                ensuring their account is active and approved.</p>
        </div>

        <div class="faq-card">
            <h5><i class="bi bi-question-circle"></i> Who do I contact for system issues?</h5>
            <p>Please contact the technical support team listed in the "Contact" section of the portal footer for any
                technical issues or bugs.</p>
        </div>

    </div>

    <footer class="text-center mt-5">
        <div class="container">
            <p>&copy; 2025 CURE Portal. All rights reserved.</p>
            <p><a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">Contact</a></p>
        </div>
    </footer>

</body>

</html>