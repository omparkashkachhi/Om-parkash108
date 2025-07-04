<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $role = mysqli_real_escape_string($connect, $_POST['role']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Check user credentials
    $query = "SELECT * FROM users WHERE email = '$email' AND role = '$role'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if ($user['password'] === $password) {

            // Clear previous session
            session_unset();

            // Set common session values
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];

            // Fetch role-specific data
            if ($role === 'patient') {
                $patientQuery = "SELECT full_name FROM patients WHERE user_id = '{$user['id']}'";
                $patientResult = mysqli_query($connect, $patientQuery);
                if ($patientData = mysqli_fetch_assoc($patientResult)) {
                    $_SESSION['patient_name'] = $patientData['full_name'];
                }
                header("Location: ../patient/index.php");
                exit();

            } elseif ($role === 'hospital') {
                $hospitalQuery = "SELECT hospital_name FROM hospitals WHERE user_id = '{$user['id']}'";
                $hospitalResult = mysqli_query($connect, $hospitalQuery);
                if ($hospitalData = mysqli_fetch_assoc($hospitalResult)) {
                    $_SESSION['hospital_name'] = $hospitalData['hospital_name'];
                }
                header("Location: ../hospital/index.php");
                exit();

            } elseif ($role === 'admin') {
                header("Location: ../admin/index.php");
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }

        } else {
            echo "<script>alert('Incorrect Password'); window.history.back();</script>";
        }

    } else {
        echo "<script>alert('Invalid Email or Role'); window.history.back();</script>";
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>