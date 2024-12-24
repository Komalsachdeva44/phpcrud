<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Footer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        footer p {
            margin: 10px 0;
        }

        footer .social-icons {
            margin: 15px 0;
        }

        footer .social-icon {
            margin: 0 10px;
            text-decoration: none;
        }

        footer .social-icon img {
            width: 30px;
            height: 30px;
            transition: transform 0.3s ease;
        }

        footer .social-icon img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>

    <!-- Your page content goes here -->

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Your Website Name. All Rights Reserved.</p>
            
            <p>Stay Connected</p>
        </div>
    </footer>

</body>
</html>
