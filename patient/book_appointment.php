<?php
include '../includes/db_connect.php';

// Fetch patients
$patientsResult = $connect->query("SELECT id, full_name FROM patients");
$patients = $patientsResult->fetch_all(MYSQLI_ASSOC);

// Fetch hospitals
$hospitalResult = $connect->query("SELECT id, hospital_name FROM hospitals");
$hospitals = $hospitalResult->fetch_all(MYSQLI_ASSOC);

// Appointment types
$appointment_types = ['Consultation', 'Vaccination', 'Follow-up', 'Emergency'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = (int) $_POST['patient_id'];
    $hospital_id = (int) $_POST['hospital_id'];
    $appointment_type = $_POST['appointment_type'];
    $status = $_POST['status'];
    $appointment_date = $_POST['appointment_date'];

    // Validate patient existence
    $checkPatient = $connect->prepare("SELECT id FROM patients WHERE id = ?");
    $checkPatient->bind_param("i", $patient_id);
    $checkPatient->execute();
    $checkPatient->store_result();

    if ($checkPatient->num_rows === 0) {
        echo "<script>alert('Invalid Patient ID.'); window.location='book_appointment.php';</script>";
        exit();
    }
    $checkPatient->close();

    // Validate hospital existence
    $checkHospital = $connect->prepare("SELECT id FROM hospitals WHERE id = ?");
    $checkHospital->bind_param("i", $hospital_id);
    $checkHospital->execute();
    $checkHospital->store_result();

    if ($checkHospital->num_rows === 0) {
        echo "<script>alert('Invalid Hospital ID.'); window.location='book_appointment.php';</script>";
        exit();
    }
    $checkHospital->close();

    // Insert Appointment
    $bookappoquery = "INSERT INTO appointments (patient_id, hospital_id, appointment_type, status, appointment_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($bookappoquery);
    $stmt->bind_param('iisss', $patient_id, $hospital_id, $appointment_type, $status, $appointment_date);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Failed to book appointment.'); window.location='book_appointment.php';</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --primary: #0d6efd;
            --accent: #2BBBAD;
            --bg: #f8f9fa;
            --text: #222;
        }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--text);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(13, 110, 253, 0.08);
            padding: 32px 24px;
        }

        h2 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 28px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        input,
        select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        input:focus,
        select:focus {
            border-color: var(--accent);
            outline: none;
        }

        button {
            width: 100%;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: linear-gradient(90deg, var(--accent), var(--primary));
        }

        @media (max-width: 600px) {
            .container {
                padding: 18px 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Book Appointment</h2>
        <form method="post" action="">
            <label for="patient_id">Patient Name</label>
            <select id="patient_id" name="patient_id" required>
                <option value="">Select Patient</option>
                <?php foreach ($patients as $patient): ?>
                    <option value="<?= htmlspecialchars($patient['id']) ?>">
                        <?= htmlspecialchars($patient['full_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>



            <label for="hospital_id">Hospital Name</label>
            <select id="hospital_id" name="hospital_id" required>
                <option value="">Select Hospital</option>
                <?php foreach ($hospitals as $hospital): ?>
                    <option value="<?= htmlspecialchars($hospital['id']) ?>">
                        <?= htmlspecialchars($hospital['hospital_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="appointment_type">Appointment Type</label>
            <select id="appointment_type" name="appointment_type" required>
                <option value="">Select Type</option>
                <?php foreach ($appointment_types as $type): ?>
                    <option value="<?= htmlspecialchars($type) ?>">
                        <?= htmlspecialchars($type) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <label for="appointment_date">Appointment Date</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <button type="submit">Book Appointment</button>
        </form>
    </div>
</body>

</html>