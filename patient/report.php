<?php
// Sample database connection (update with your credentials)
include '../includes/db_connect.php';

// Fetch patient reports (customize query as needed)
// $sql = "SELECT id, patient_id, type, description, date, status FROM  vaccination_status ORDER By date DESC";
$sql = "
SELECT 
    p.full_name AS patient_name,
    vs.type As vaccine_name,
    vs.description AS description,
    vs.date AS report_date,
    vs.status
FROM reports vs
JOIN patients p ON vs.patient_id = p.id
ORDER BY vs.date DESC";
$result = $connect->query($sql);
if (!$result) {
    die("Query failed: " . $connect->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vaccination Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(90deg, #2BBBAD 100%, #0d6efd 60%);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
        }

        .report-table th {
            background: #2BBBAD;
            color: #fff;
        }

        .report-table tr:nth-child(even) {
            background: #e3f2fd;
        }

        .status-completed {
            color: #fff;
            background: #2BBBAD;
            border-radius: 0.5rem;
            padding: 0.2rem 0.7rem;
            font-size: 0.95em;
        }

        .status-pending {
            color: #fff;
            background: #ffc107;
            border-radius: 0.5rem;
            padding: 0.2rem 0.7rem;
            font-size: 0.95em;
        }

        @media (max-width: 768px) {

            .report-table th,
            .report-table td {
                font-size: 0.95em;
                padding: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Vaccination System</a>
        </div>
    </nav>
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header" style="background: #2BBBAD; color: #fff;">
                <h4 class="mb-0">Patient Vaccination Report</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table report-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Vaccine</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php $i = 1;
                                while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                        <td><?= htmlspecialchars($row['vaccine_name']) ?></td>
                                        <td><?= htmlspecialchars($row['description']) ?></td>
                                        <td><?= htmlspecialchars(date('d M Y', strtotime($row['report_date']))) ?></td>
                                        <td>
                                            <?php if ($row['status'] === 'Completed'): ?>
                                                <span class="status-completed">Completed</span>
                                            <?php else: ?>
                                                <span class="status-pending">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No reports found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php $connect->close(); ?></thead>
</div>
</div>