<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universitysystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_course'])) {
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $pre_requisite = $_POST['pre_requisite'];
    $credits = $_POST['credits'];

    if (empty($course_name) || empty($course_code) || empty($credits)) {
        $message = "All fields are required.";
    } else {
        $insert_query = "INSERT INTO courses (course_name, course_code, pre_requisite, credits) VALUES ('$course_name', '$course_code', '$pre_requisite', '$credits')";

        if (mysqli_query($conn, $insert_query)) {
            $message = "Course added successfully";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: white;
            background: #1E2A5E;
            padding: 10px 0;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #1E2A5E;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #303f84;
        }
        .message {
            text-align: center;
            font-size: 18px;
            color: #ff0000;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Add New Course</h1>

<p class="message"><?php if (isset($message)) { echo $message; } ?></p>

<form method="POST" action="">
    <label for="course_name">Course Name</label>
    <input type="text" id="course_name" name="course_name" required>

    <label for="course_code">Course Code</label>
    <input type="text" id="course_code" name="course_code" required>

    <label for="pre_requisite">Pre-requisite</label>
    <input type="text" id="pre_requisite" name="pre_requisite">

    <label for="credits">Credits</label>
    <input type="text" id="credits" name="credits" required>

    <input type="submit" name="add_course" value="Add Course">
</form>

</body>
</html>
