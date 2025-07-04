<?php
// results.php

include '../includes/db_connect.php';
// Include your database connection file


$sql = "
SELECT 
    p.full_name AS patient_name,
    vs.vaccine_name,
    vs.dose_number,
    vs.date_given AS vaccination_date,
    vs.status
FROM vaccination_status vs
JOIN patients p ON vs.patient_id = p.id
JOIN hospitals h ON vs.hospital_id = h.id
ORDER BY vs.date_given DESC
";
$result = $connect->query($sql);
if (!$result) {
    die("Query failed: " . $connect->error);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vaccination Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --primary: #2BBBAD;

            --bg: #f8f9fa;
            --text: #212529;
            --border: #dee2e6;
            --success: #2BBBAD;
            --pending: #ffc107;
            --failed: #dc3545;
        }

        body {
            background: #2BBBAD;
            color: var(--text);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(13, 110, 253, 0.08);
            padding: 32px 24px;
        }

        h2 {
            color: var(--primary);
            margin-bottom: 28px;
            text-align: center;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(43, 187, 173, 0.07);
        }

        th,
        td {
            padding: 14px 12px;
            text-align: left;
        }

        th {
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--accent);
        }

        tr:nth-child(even) {
            background: #f3f7fa;
        }

        tr:hover {
            background: #e7f1fc;
            transition: background 0.2s;
        }

        .status-success {
            color: #fff;
            background: var(--success);
            border-radius: 16px;
            padding: 4px 12px;
            display: inline-block;
            font-weight: 500;
        }

        .status-pending {
            color: #fff;
            background: var(--pending);
            border-radius: 16px;
            padding: 4px 12px;
            display: inline-block;
            font-weight: 500;
        }

        .status-failed {
            color: #fff;
            background: var(--failed);
            border-radius: 16px;
            padding: 4px 12px;
            display: inline-block;
            font-weight: 500;
        }

        @media (max-width: 700px) {
            .container {
                padding: 16px 4px;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 18px;
                background: #fff;
                box-shadow: 0 1px 4px rgba(43, 187, 173, 0.07);
                border-radius: 8px;
                padding: 8px 0;
            }

            td {
                position: relative;
                padding-left: 48%;
                min-height: 36px;
                border-bottom: 1px solid var(--border);
            }

            td:before {
                position: absolute;
                left: 16px;
                top: 12px;
                width: 45%;
                white-space: nowrap;
                font-weight: 600;
                color: var(--primary);
                content: attr(data-label);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Vaccination Results</h2>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Vaccine</th>
                    <th>Dose</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['patient_name']) ?></td>
                            <td><?= htmlspecialchars($row['vaccine_name']) ?></td>
                            <td><?= htmlspecialchars($row['dose_number']) ?></td>
                            <td><?= htmlspecialchars(date("d M Y", strtotime($row['vaccination_date']))) ?></td>
                            <td class="status-<?= strtolower($row['status']) ?>">
                                <?= htmlspecialchars(ucfirst($row['status'])) ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php $connect->close(); ?>