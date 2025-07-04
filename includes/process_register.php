<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = strtolower(mysqli_real_escape_string($connect, $_POST['email']));
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connect, $_POST['confirm_password']);
    $role = mysqli_real_escape_string($connect, $_POST['role']);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register.php");
        exit();
    }

    $checkQuery = "SELECT id FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['error'] = "Email already registered.";
        header("Location: register.php");
        exit();
    }

    $insertUser = "INSERT INTO users (name, email, password, role, created_at) 
                   VALUES ('$name', '$email', '$password', '$role', NOW())";

    if (mysqli_query($connect, $insertUser)) {

        $userId = mysqli_insert_id($connect);

        // Insert into respective table
        if ($role === 'admin') {
            $adminInsert = "INSERT INTO admin (user_id, name, email, password) VALUES ('$userId', '$name', '$email', '$password')";
            mysqli_query($connect, $adminInsert);
        } elseif ($role === 'hospital') {
            $hospitalInsert = "INSERT INTO hospitals (user_id, hospital_name, email, password, approved) VALUES ('$userId', '$name', '$email', '$password', 0)";
            mysqli_query($connect, $hospitalInsert);
        } elseif ($role === 'patient') {
            $patientInsert = "INSERT INTO patients (user_id, full_name, email, password) VALUES ('$userId', '$name', '$email', '$password')";
            mysqli_query($connect, $patientInsert);
        }

        $_SESSION['user_id'] = $userId;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['name'] = $name;

        if ($role === 'admin') {
            header("Location: ../admin/index.php");
        } elseif ($role === 'hospital') {
            header("Location: ../hospital/index.php");
        } elseif ($role === 'patient') {
            header("Location: ../patient/index.php");
        } else {
            $_SESSION['error'] = "Invalid role.";
            header("Location: register.php");
        }
        exit();

    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: register.php");
        exit();
    }
}
?>