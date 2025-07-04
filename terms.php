<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Terms & Conditions - COVID-19 Vaccination System</title>
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
        <div class="terms-container">
            <h2>Terms & Conditions</h2>
            <p>Welcome to the COVID-19 Vaccination System. By using this platform, you agree to the following terms and
                conditions:</p>

            <ul>
                <li>All users must provide accurate personal and medical information when registering or booking
                    appointments.</li>
                <li>Hospitals are responsible for maintaining updated information regarding vaccination availability.
                </li>
                <li>The system is intended solely for the management of COVID-19 tests, vaccinations, and related
                    reports.</li>
                <li>Misuse of the system, including providing false information or unauthorized access, may result in
                    account suspension.</li>
                <li>Personal information is handled in accordance with our <a href="privacy.php">Privacy Policy</a>.
                </li>
                <li>The system administrators reserve the right to modify these terms at any time with prior notice.
                </li>
            </ul>

            <p class="mt-3">By continuing to use this system, you confirm your acceptance of these Terms & Conditions.
            </p>

            <div class="mt-4 text-center">
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            &copy; 2025 COVID-19 Vaccination System. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>