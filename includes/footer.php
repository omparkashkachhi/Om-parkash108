</div>

<footer style="background:#222;color:#fff;padding:20px 0;text-align:center;width:100%;">
    <div
        style="max-width:1200px;margin:0 auto;display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;">
        <div style="flex:1 1 200px;text-align:left;padding:10px;">
            <h4>Vaccination System</h4>
            <p>&copy; <?php echo date("Y"); ?> All rights reserved.</p>
        </div>
        <div style="flex:1 1 200px;text-align:right;padding:10px;">
            <a href="/about.php" style="color:#fff;margin:0 10px;text-decoration:none;">About</a>
            <a href="/contact.php" style="color:#fff;margin:0 10px;text-decoration:none;">Contact</a>
        </div>
    </div>
    <?php
    // Dynamic footer links
    $footerLinks = [
        ['label' => 'About', 'url' => '/about.php'],
        ['label' => 'Contact', 'url' => '/contact.php'],
        // Add more links as needed
    ];

    // Dynamic site name
    $siteName = 'Vaccination System';
    ?>
    <style>
        footer {
            bottom: 0;
            width: 100%;
            background-color: #222;
            color: #fff;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
        }

        .footer-left,
        .footer-right {
            flex: 1 1 200px;
            padding: 10px;
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }

        .footer-links a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #00bcd4;
        }

        @media (max-width: 600px) {
            .footer-container {
                flex-direction: column;
                text-align: center;
            }

            .footer-left,
            .footer-right {
                text-align: center !important;
                padding: 5px !important;
            }
        }
    </style>
    <script>
        // Optional: Add JS for further dynamic behavior if needed
    </script>
</footer>
</body>

</html>