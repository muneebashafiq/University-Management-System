<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universitysystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$success = false; 
$error_message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $password = $_POST['password']; 
    $department = $_POST['department'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];

    $sql = "INSERT INTO faculty (name, email, designation, password, department, address, gender, qualification) 
            VALUES ('$name', '$email', '$designation', '$password', '$department', '$address', '$gender', '$qualification')";

    $success = mysqli_query($conn, $sql);

    if (!$success) {
        $error_message = "Error: " . mysqli_error($conn); 
    }

}

if ($success) {
    $display = "Faculty member added successfully";
} else {
    $display = $error_message; 
}
mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Faculty</title>
    <style>
       * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f4f4f4; 
            width: 100%;
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            background: #1E2A5E;
            color: white;
            padding: 10px 0;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
        }

        .button {
            background-color: #1E2A5E;
            color: #fff;
            border: none;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #303f84;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        tr:nth-child(even){
            background: #e7f6ff;
        }

    </style>
</head>
<body>

<h1>Add New Faculty</h1>

<form action="add_faculty.php" method="POST">
<p><?php if(isset($display)){ echo $display; } ?></p>
    <label for="name">Full Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="designation">Designation</label>
    <select id="designation" name="designation" required>
        <option value="Lab Engineer">Lab Engineer</option>
        <option value="Lecturer">Lecturer</option>
    </select>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <label for="department">Department</label>
    <select id="department" name="department" required>
        <option value="Software Engineering">Software Engineering</option>
        <option value="Electrical Engineering">Electrical Engineering</option>
        <option value="Arificial Intelligence">Arificial Intelligence</option>
        <option value="Computer Science">Computer Science</option>
        <option value="Cyber Security">Cyber Security</option>
    </select>

    <label for="address">Address</label>
    <input type="text" id="address" name="address">

    <label for="gender">Gender</label>
    <select id="gender" name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>

    <label for="qualification">Qualification</label>
    <select id="qualification" name="qualification" required>
        <option value="BS">BS</option>
        <option value="MS">MS</option>
        <option value="MPhil">MPhil</option>
        <option value="PhD">PhD</option>
    </select>

    <input type="submit" value="Add Faculty" class="button">
</form>

</body>
</html>
