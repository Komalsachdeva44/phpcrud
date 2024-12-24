<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          /* Center the form */
          body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        /* Card styling for the form */
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        /* Input styling */
        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container input[type="file"] {
            padding: 3px;
        }

        /* Submit button styling */
        .form-container input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #007B1F;
        }

        /* Image styling */
        .form-container img {
            margin-top: 10px;
            width: 50px;
            border-radius: 50%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (!empty($_POST['sub'])) {
    $s_name = $_POST['student_name'];
    $s_class = $_POST['student_class'];
    $s_rollno = $_POST['student_rollno']; 
    $student_id = $_POST['student_id'];
    
    // Update basic information
    $sql = "UPDATE students SET name=?, class=?, rollno=? WHERE id=?";
    $stmt = $conn->prepare($sql);  
    $stmt->bind_param("sssi", $s_name, $s_class, $s_rollno, $student_id); 
    $stmt->execute();

    // Check if a new photo was uploaded
    if (!empty($_FILES['photo']['name'])) {
        $filename = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];
        $file_arr = explode('.', $filename);
        $ext = end($file_arr);
        $filename = rand() . "." . $ext;
        
        // Move the uploaded file
        move_uploaded_file($tmp, 'images/' . $filename);
        
        // Update the photo in the database
        $sql = "UPDATE students SET photo=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $filename, $student_id);
        $stmt->execute();

        // Delete old photo if it exists
        if (!empty($_POST["old_img"])) {
            unlink("images/" . $_POST["old_img"]);
        }
    }

    // Redirect after successful update
    if ($stmt) {
        header("location:index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch student data for editing
$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = ? LIMIT 1";  
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div class="form-container">
    <form method="post" enctype="multipart/form-data"> 
        <input type="text" name="student_name" placeholder="Name" value="<?php echo $row["name"]; ?>" required>
        <input type="text" name="student_class" placeholder="Class" value="<?php echo $row["class"]; ?>" required>
        <input type="text" name="student_rollno" placeholder="Roll No" value="<?php echo $row["rollno"]; ?>" required>
        <input type="hidden" name="student_id" value="<?php echo $row["id"]; ?>"> 
        <input type="hidden" name="old_img" value="<?php echo $row["photo"]; ?>">
        <input type="file" name="photo">
        
        <?php if (!empty($row["photo"])): ?>
            <img src="images/<?php echo $row["photo"]; ?>" alt="Student Photo">
        <?php endif; ?>

        <input type="submit" name="sub" value="Update">
    </form>
</div>

<?php
$conn->close(); 
?>

</body>
</html>

