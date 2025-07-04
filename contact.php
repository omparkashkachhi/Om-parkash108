<?php
include 'includes/db_connect.php'; // Ensure this file has your DB connection

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim inputs
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $msg = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($msg)) {

        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Insert into database using prepared statements
            $stmt = $connect->prepare("INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $subject, $msg);

            if ($stmt->execute()) {
                $message = '<div class="alert alert-success">Thank you for contacting us. We will get back to you soon.</div>';
            } else {
                $message = '<div class="alert alert-danger">Error saving your message. Please try again later.</div>';
            }

            $stmt->close();

        } else {
            $message = '<div class="alert alert-warning">Please enter a valid email address.</div>';
        }

    } else {
        $message = '<div class="alert alert-danger">Please fill in all required fields.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - Vaccination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #2d6cdf;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 500;
        }

        input,
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            background: #2d6cdf;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #1a4fa0;
        }

        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .success {
            background: #e6f9e6;
            color: #256029;
            border: 1px solid #b6e2b6;
        }

        .error {
            background: #ffeaea;
            color: #a94442;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 600px) {
            .container {
                padding: 18px 8px;
            }
        }

        .contact-info {
            margin-top: 30px;
            font-size: 0.97em;
            color: #555;
        }

        .contact-info strong {
            color: #2d6cdf;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Contact Us</h2>
        <?php echo $message; ?>
        <form method="post" action="">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" required
                value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">

            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required
                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

            <label for="subject">Subject *</label>
            <input type="text" id="subject" name="subject" required
                value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">

            <label for="message">Message *</label>
            <textarea id="message" name="message"
                required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>

            <button type="submit">Send Message</button>
        </form>
        <div class="contact-info">
            <p><strong>Email:</strong> info@vaccinationsystem.com</p>
            <p><strong>Phone:</strong> +1 234 567 890</p>
            <p><strong>Address:</strong> 123 Health St, City, Country</p>
        </div>
    </div>
</body>

</html>