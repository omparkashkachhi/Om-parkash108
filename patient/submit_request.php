<?php
// Handle form submission
$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simple validation
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $vaccine = trim($_POST['vaccine'] ?? '');
    $date = trim($_POST['date'] ?? '');

    if ($name && $email && $vaccine && $date) {
        // Here you would typically insert the request into a database
        // $success = true;
        // Optionally, you can redirect after success:
        header('Location: index.php');
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Submit Vaccination Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --primary: #0d6efd;
            --accent: #2BBBAD;
            --bg: #f8f9fa;
            --text: #212529;
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
            box-shadow: 0 2px 12px rgba(13, 110, 253, 0.08);
            padding: 32px 24px;
        }

        h2 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 24px;
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

        .btn {
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

        .btn:hover {
            background: linear-gradient(90deg, var(--accent), var(--primary));
        }

        .alert {
            padding: 10px 14px;
            border-radius: 5px;
            margin-bottom: 18px;
            font-size: 0.98rem;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        @media (max-width: 500px) {
            .container {
                padding: 18px 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Vaccination Request</h2>
        <?php if ($success): ?>
            <div class="alert alert-success">Your request has been submitted successfully!</div>
        <?php elseif ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <label for="vaccine">Vaccine Type</label>
            <select id="vaccine" name="vaccine" required>
                <option value="">Select Vaccine</option>
                <option value="Pfizer" <?= (($_POST['vaccine'] ?? '') === 'Pfizer') ? 'selected' : '' ?>>Pfizer</option>
                <option value="Moderna" <?= (($_POST['vaccine'] ?? '') === 'Moderna') ? 'selected' : '' ?>>Moderna
                </option>
                <option value="AstraZeneca" <?= (($_POST['vaccine'] ?? '') === 'AstraZeneca') ? 'selected' : '' ?>>
                    AstraZeneca</option>
                <option value="Sinovac" <?= (($_POST['vaccine'] ?? '') === 'Sinovac') ? 'selected' : '' ?>>Sinovac
                </option>
            </select>

            <label for="date">Preferred Date</label>
            <input type="date" id="date" name="date" required value="<?= htmlspecialchars($_POST['date'] ?? '') ?>">

            <button type="submit" class="btn">Submit Request</button>
        </form>
    </div>
</body>

</html>