<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Form</title>
    <style>
        /* Body styling */
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form container */
        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        /* Heading styling */
        h2 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Input fields */
        input[type="text"], 
        input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        /* Buttons */
        input[type="submit"], 
        input[type="button"] {
            background-color: rgb(69, 72, 160);
            color: white;
            padding: 10px 15px;
            margin: 10px 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover, 
        input[type="button"]:hover {
            background-color:rgb(69, 72, 160);
        }

        /* Adjusting file input */
        input[type="file"] {
            background-color: #f9f9f9;
            padding: 5px;
        }

        /* Responsive Design */
        @media screen and (max-width: 480px) {
            form {
                padding: 15px 20px;
            }

            input[type="text"], 
            input[type="file"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <form method="post" action="db.php" enctype="multipart/form-data">
        <h2>Customer Information</h2>
        <input type="text" name="student_name" placeholder="Name" required>
        <input type="text" name="student_class" placeholder="Class" required>
        <input type="text" name="student_rollno" placeholder="Roll NO" required>
        <input type="file" name="photo">
        <input type="submit" name="sub" value="Submit">
        <input type="button" name="button_two" value="View Details" onclick="window.location.href='viewData.php'">
    </form>
</body>
</html>
