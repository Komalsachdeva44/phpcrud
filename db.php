<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* Style for the button */
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f2f5;
        font-family: Arial, sans-serif;
        margin: auto;
    }

    button {
        background-color: #4CAF50;
        /* Green background */
        color: white;
        /* White text */
        padding: 20px 20px;
        /* Add padding */
        border: none;
        /* Remove border */
        border-radius: 5px;
        /* Rounded corners */
        cursor: pointer;
        /* Change cursor to pointer */
        font-size: 16px;
        /* Larger text */
        transition: background-color 0.3s ease;
        /* Smooth transition */
    }

    /* Hover effect for the button */
    button:hover {
        background-color: #45a049;
        /* Darker green when hovered */
    }
    </style>
</head>

<body>
    <?php
//ways to connect my sql data base 

// 1) Mysqli Extension 
// 2) Pdo Php data objects 

//connecting to database
$servarname="localhost";
$username="root";
$password="";
$db_name="phpdb";
//create a connection object
//die if connection was not successfull
$con= mysqli_connect($servarname,$username,$password,$db_name);
if(!$con) 
{
    die("sorry we failed to connect " .mysqli_connect_error());
}
else{
// echo"connection done";
}

if (isset($_POST['sub'])) {
    $s_name = $_POST['student_name'];
    $s_class = $_POST['student_class'];
    $s_rollno = $_REQUEST['student_rollno'];
    $filename =  $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    $type = $_FILES['photo']['type'];
    /*$ext = "";
    if($type == 'image/png'){
        $ext = ".png";
    }*/

    $file_arr = explode('.', $filename); // opposite implode('.',$file_arr);
    $ext = end($file_arr); 
     $filename =  rand().".".$ext; 
    move_uploaded_file($tmp, 'images/'.$filename);    $stmt = $con->prepare("INSERT INTO students(name, class, rollno,photo) VALUES (?, ?, ?,?)");

    $stmt->bind_param("ssss", $s_name, $s_class, $s_rollno,$filename);

    if ($stmt->execute()) {
        // echo "New record created successfully";
        header("location:viewData.php");

    } else {
        echo "Error: " . $stmt->error;
    }

    $con->close();
}
?>
    <button onclick="viewData()">View Data</button>

    <script>
    function viewData() {
        window.location.href = "viewData.php";
    }
    </script>
</body>

</html>