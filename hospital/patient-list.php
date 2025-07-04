<?php
include '../includes/db_connect.php'; // Assumes $conn is your connection variable

$patients = [];

$sql = "
    SELECT 
        patients.id, 
        patients.full_name, 
        patients.age, 
        patients.gender, 
        vaccines.name AS vaccine_name, 
        vaccination_status.status, 
        hospitals.hospital_name AS hospital_name
    FROM 
        patients
    LEFT JOIN 
        vaccines ON patients.id = vaccines.id
    LEFT JOIN 
        vaccination_status ON patients.id = vaccination_status.patient_id
    LEFT JOIN 
        hospitals ON patients.id = hospitals.id
";

$result = $connect->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --primary: #2bbbad;
            --accent: #0d6efd;
            --bg: #f8f9fa;
            --text: #222;
        }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            color: var(--text);
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.08);
            padding: 24px;
        }

        h2 {
            color: var(--primary);
            margin-bottom: 24px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th,
        td {
            padding: 14px 10px;
            text-align: left;
        }

        th {
            background: var(--primary);
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background: #f2f8fd;
        }

        .status-vaccinated {
            color: #fff;
            background: var(--accent);
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.95em;
            display: inline-block;
        }

        .status-pending {
            color: #fff;
            background: var(--primary);
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.95em;
            display: inline-block;
        }

        @media (max-width: 700px) {
            .container {
                padding: 8px;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 18px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 1px 4px rgba(43, 187, 173, 0.07);
            }

            td {
                padding: 10px;
                position: relative;
                text-align: right;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                top: 10px;
                font-weight: bold;
                color: var(--primary);
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Patient List</h2>
        <table>
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Vaccine</th>
                    <th>Status</th>
                    <th>Hospital Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td data-label="#ID"><?php echo htmlspecialchars($patient['id']); ?></td>
                        <td data-label="Name"><?php echo htmlspecialchars($patient['full_name']); ?></td>
                        <td data-label="Age"><?php echo htmlspecialchars($patient['age']); ?></td>
                        <td data-label="Gender"><?php echo htmlspecialchars($patient['gender']); ?></td>
                        <td data-label="Vaccine"><?php echo htmlspecialchars($patient['vaccine_name']); ?></td>
                        <td data-label="Status">
                            <?php if (strtolower($patient['status']) === 'vaccinated'): ?>
                                <span class="status-vaccinated">Vaccinated</span>
                            <?php else: ?>
                                <span class="status-pending">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td data-label="Hospital Name"><?php echo htmlspecialchars($patient['hospital_name']); ?></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>