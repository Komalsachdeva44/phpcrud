<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h2, h1 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }
        /* Refined Styling for Search Form */
        .search-container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            max-width: 800px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .search-container form {
            display: flex;
            gap: 10px;
            width: 100%;
            justify-content: center;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 30%;
            font-size: 16px;
            outline: none;
            transition: border 0.3s;
        }

        .search-container input[type="text"]:focus {
            border-color: #007BFF;
        }

        .search-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .search-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-top: 10px;
        }

        th {
            background-color: #007BFF;
            color: #fff;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 80px;
            height: auto;
            border-radius: 8px;
        }

        .action-links a {
            text-decoration: none;
            color: #007BFF;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .action-links a:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .add-record {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .add-record:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "phpdb";
    
    $con = mysqli_connect($servername, $username, $password, $db_name);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete student record if requested
    if (!empty($_GET['del_id']) && !empty($_GET['img_id'])) {
        // Get the student ID and image file name
        $del_id = $_GET['del_id'];
        $img_id = $_GET['img_id'];

        // SQL query to delete the student record
        $sql = "DELETE FROM students WHERE id = '$del_id'";
        if (mysqli_query($con, $sql)) {
            // Remove the image file from the server
            unlink("images/" . $img_id);
            // Redirect back to the page after deletion
            header("Location: viewData.php");
            exit(); // Ensure no further code execution
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

    // Fetch students from database
    $sql = "SELECT * FROM students WHERE 1"; 
    if (!empty($_GET['student_name'])) $sql .= " AND name LIKE '%" . $_GET['student_name'] . "%'";
    if (!empty($_GET['student_class'])) $sql .= " AND class = '" . $_GET['student_class'] . "'";
    if (!empty($_GET['student_rollno'])) $sql .= " AND rollno = '" . $_GET['student_rollno'] . "'";

    $result = $con->query($sql);  
    ?>

    <h2>Student Information</h2>

    <!-- Search Form -->
    <div class="search-container">
        <h1>Search Students</h1>
        <form method="get" enctype="multipart/form-data"> 
            <input type="text" name="student_name" value="<?php if (!empty($_GET['student_name'])) echo $_GET['student_name']; ?>" placeholder="Name">
            <input type="text" name="student_class" value="<?php if (!empty($_GET['student_class'])) echo $_GET['student_class']; ?>" placeholder="Class">
            <input type="text" name="student_rollno" value="<?php if (!empty($_GET['student_rollno'])) echo $_GET['student_rollno']; ?>" placeholder="Roll No">  
            <input type="submit" name="srch" value="Search">
        </form>
    </div>

    <!-- Student Table -->
    <table>
        <tr>
            <th>Name</th>
            <th>Roll No</th>
            <th>Class</th>
            <th>Photo</th>
            <th>Details</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["rollno"]; ?></td>
                    <td><?php echo $row["class"]; ?></td>
                    <td><img src="images/<?php echo $row["photo"]; ?>" alt="Student Photo"></td>
                    <td><a href="detail.php?id=<?php echo $row["id"]; ?>">Detail</a></td>
                    <td class="action-links">
                        <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a> | 
                        <a href="viewData.php?del_id=<?php echo $row["id"]; ?>&img_id=<?php echo $row["photo"]; ?>">Delete</a>
                    </td>
                </tr>
                <?php 
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }
        ?>
    </table>

    <a class="add-record" href="index.php">Add Records</a>

    <?php
    mysqli_close($con); 
    ?>
</body>
</html>
