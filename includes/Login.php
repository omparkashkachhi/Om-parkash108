<!-- <?php

include 'db_connect.php';
session_start();

// if (isset($_POST['submit'])) {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//     // Insert into database
//     $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
//     $result = mysqli_query($connect, $query);

//     if (isset($_POST['role'])) {
//         $role = $_POST['role'];
//         if ($role === 'patient') {
//             header('Location: patient_dashboard.php');
//             exit();
//         } elseif ($role === 'hospital') {
//             header('Location: hospital_dashboard.php');
//             exit();
//         }
//     }


// }



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate role
    if (in_array($role, ['patient', 'hospital', 'admin'])) {
        // Prepare and execute query
        $query = "SELECT * FROM users WHERE email='$email' AND role='$role' LIMIT 1";
        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                // Login success
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                switch ($user['role']) {
                    case 'patient':
                        header('Location: patient_dashboard.php');
                        break;
                    case 'hospital':
                        header('Location: hospital_dashboard.php');
                        break;
                    case 'admin':
                        header('Location: admin_dashboard.php');
                        break;
                }
                exit();
            } else {
                echo "<div class='alert alert-danger'>❌ Invalid password.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>❌ No user found with this email and role.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>⚠️ Please select a valid role.</div>";
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>COVID Portal Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
<!-- Responsive and dynamic login styles -->
<style>
body {
    background: linear-gradient(135deg, #4f8cff 0%, #38e6c5 100%);
    font-family: 'Roboto', sans-serif;
    min-height: 100vh;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-container {
    background: #fff;
    padding: 2.5rem 2rem;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
    max-width: 350px;
    width: 100%;
    margin: 2rem auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    animation: fadeIn 1s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-container h2 {
    margin-bottom: 1.5rem;
    font-weight: 700;
    color: #2d3a4b;
    letter-spacing: 1px;
}

.login-container input,
.login-container select {
    width: 100%;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    border: 1px solid #dbeafe;
    border-radius: 8px;
    font-size: 1rem;
    background: #f7fafc;
    transition: border 0.2s;
}

.login-container input:focus,
.login-container select:focus {
    border-color: #4f8cff;
    outline: none;
    background: #fff;
}

.login-container button {
    width: 100%;
    padding: 0.75rem;
    background: linear-gradient(90deg, #4f8cff 0%, #38e6c5 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    box-shadow: 0 2px 8px rgba(79, 140, 255, 0.1);
}

.login-container button:hover {
    background: linear-gradient(90deg, #38e6c5 0%, #4f8cff 100%);
    transform: translateY(-2px) scale(1.02);
}

@media (max-width: 480px) {
    .login-container {
        padding: 1.5rem 0.5rem;
        max-width: 95vw;
    }

    .login-container h2 {
        font-size: 1.3rem;
    }
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Spacer for fixed header -->
    <div class="login-container">
        <h2>Login to COVID System</h2>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <select name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="hospital">Hospital</option>
                <option value="patient">Patient</option>
            </select>

            <button type="submit">Login</button>
        </form>
        <p style="margin-top: 1rem;">
            Don't have an account? <a href="register.php">Create Account</a>
        </p>
    </div>