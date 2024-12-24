<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Center the content */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            margin: auto;
        }

        /* Card styling */
        .card {
            width: 300px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
        }

        /* Image styling */
        .card img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        /* Card content styling */
        .card-content {
            padding: 20px;
        }

        .card-content h2 {
            margin: 10px 0;
            font-size: 20px;
            color: #333;
        }

        .card-content p {
            margin: 5px 0;
            color: #777;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpdb"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $id = $_GET['id'];
    // SQL query
    $sql = "SELECT * FROM students WHERE id = ".$id." LIMIT 1";  
    $result = $conn->query($sql); 
    $row = $result->fetch_assoc();
    ?>

    <div class="card">
        <img src="images/<?php echo $row["photo"]; ?>" alt="Student Photo">
        <div class="card-content">
            <h2><?php echo $row["name"]; ?></h2>
            <p>Roll No: <?php echo $row["rollno"]; ?></p>
            <p>Class: <?php echo $row["class"]; ?></p>
        </div>
    </div>

    <?php
    // Close connection
    $conn->close(); 
    ?>
</body>
</html>
