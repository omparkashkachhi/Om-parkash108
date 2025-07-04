<?php
// Database connection (update with your credentials)
$host = "localhost";
$user = "root";
$pass = "";
$db = "vaccination_system";

$connect = new mysqli($host, $user, $pass, $db);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$search = '';
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = trim($_POST['search']);
    $stmt = $connect->prepare("SELECT id, name, dob, gender, contact FROM patients WHERE name LIKE ? OR id = ?");
    $like = "%$search%";
    $stmt->bind_param("ss", $like, $search);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f8;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f0f4f8;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th {
                position: absolute;
                left: -9999px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                left: 10px;
                top: 10px;
                white-space: nowrap;
                font-weight: bold;
            }

            td:nth-of-type(1):before {
                content: "Patient ID";
            }

            td:nth-of-type(2):before {
                content: "Name";
            }

            td:nth-of-type(3):before {
                content: "DOB";
            }

            td:nth-of-type(4):before {
                content: "Gender";
            }

            td:nth-of-type(5):before {
                content: "Contact";
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Search Patient</h2>
        <form method="post" autocomplete="off">
            <input type="text" name="search" placeholder="Enter patient name or ID"
                value="<?php echo htmlspecialchars($search); ?>" required>
            <button type="submit">Search</button>
        </form>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <?php if (count($results) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['dob']); ?></td>
                                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #d00; text-align: center;">No patients found.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>

</html>
<?php $connect->close(); ?>