<?php
session_start();
if (!isset($_SESSION['users'])) {
    header('Location: index.php');
    exit();
}
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Logout - Vaccination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #4fc3f7, #1976d2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-container {
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.10);
            text-align: center;
            max-width: 350px;
            width: 100%;
        }

        .logout-container h2 {
            color: #1976d2;
            margin-bottom: 1rem;
        }

        .logout-container p {
            color: #333;
            margin-bottom: 2rem;
        }

        .logout-container a {
            display: inline-block;
            padding: 0.7rem 1.5rem;
            background: #1976d2;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }

        .logout-container a:hover {
            background: #1565c0;
        }

        @media (max-width: 500px) {
            .logout-container {
                padding: 1.2rem 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="logout-container">
        <h2>Logged Out</h2>
        <p>You have been successfully logged out.</p>
        <a href="login.php">Return to Login</a>
    </div>
</body>

</html>