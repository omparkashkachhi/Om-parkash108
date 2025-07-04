<?php
// appointments.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Appointment Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Simple CSS for responsiveness -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgb(191, 218, 245);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 24px 32px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 16px 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Book an Appointment</h2>
        <form action="process_appointment.php" method="POST">
            <label for="patient_name">Patient Name</label>
            <input type="text" id="patient_name" name="patient_name" required>

            <label for="patient_email">Email</label>
            <input type="email" id="patient_email" name="patient_email" required>

            <label for="patient_phone">Phone Number</label>
            <input type="tel" id="patient_phone" name="patient_phone" required pattern="[0-9]{10,15}">
            <label for="appointment_date">Appointment Date</label>
            <input type="date" id="appointment_date" name="appointment_date" required>
            <label for="appointment_time">Appointment Time</label>
            <input type="time" id="appointment_time" name="appointment_time" required>

            <label for="vaccine_type">Vaccine Type</label>
            <select id="vaccine_type" name="vaccine_type" required>
                <option value="">Select Vaccine</option>
                <option value="pfizer">Pfizer</option>
                <option value="moderna">Moderna</option>
                <option value="astrazeneca">AstraZeneca</option>
                <option value="johnson">Johnson & Johnson</option>
            </select>
            <label for="additional_info">Additional Information</label>
            <textarea id="additional_info" name="additional_info" rows="4"
                placeholder="Any additional information..."></textarea>
            <button type="submit">Book Appointment</button>
        </form>
    </div>