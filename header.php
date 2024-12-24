<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* body {
            font-family: Arial, sans-serif;
        } */

        .site-header {
            background-color: #333;
            color: white;
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo a {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            font-family: 'Lobster', cursive;
        }

        .nav ul {
            display: flex;
            gap: 20px;
        }
        li {
            list-style: none;
        }
        .nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s ease;
            font-family: 'Muli', sans-serif;
        }

        .nav ul li a:hover {
            color: #ff8c00;
        }

        .cta .btn {
            background-color: #007BFF;
            cursor: pointer;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .cta .btn:hover {
            background-color: #e67e00;
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="">MyWebsite</a>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/services">Services</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </nav>
            <div class="cta">
                <button onclick="formm()" class="btn">Submit Data</button>
            </div>
        </div>
    </header>

    <script>
        function formm() {
            window.location.href = "index.php"; 
        }
    </script>
</body>
</html>
