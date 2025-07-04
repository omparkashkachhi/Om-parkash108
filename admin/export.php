<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=appointments_report.xls");

include '../includes/db_connect.php';
$result = $connect->query("SELECT * FROM appointments");

echo "Patient\tHospital\tType\tDate\tStatus\tTest Result\tVaccination Status\n";

while ($row = $result->fetch_assoc()) {
    echo $row['patient_username'] . "\t" . $row['hospital_id'] . "\t" . $row['appointment_type'] . "\t" . $row['appointment_date'] . "\t" . $row['status'] . "\t" . $row['test_result'] . "\t" . $row['vaccination_status'] . "\n";
}
?>