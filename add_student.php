<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universitysystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$success = false; 
$error_message = ''; 

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $session =  $_POST['session'];
    $gender = $_POST['gender'];
    $address =  $_POST['address'];
    $program = $_POST['program'];

    // Extract admission year from session
    $admission_year = explode('-', $session)[0];

    // Extract department from program
    $department = explode(' ', $program)[1];

    // Query to count existing records for the session and program
    $count_query = "SELECT COUNT(*) AS count FROM students WHERE session = '$session' AND program = '$program'";
    $count_result = mysqli_query($conn, $count_query);
    $row = mysqli_fetch_assoc($count_result);
    $count = $row['count'] + 1; 

    // Format registration number
    $registration_number = sprintf("%04d-%s-%02d", $admission_year, $department, $count);

    // Insert new student record
    $insert_query = "INSERT INTO students (name, email, phone, password, session, gender, address, registration_number, program) 
                     VALUES ('$name', '$email', '$phone', '$password', '$session', '$gender', '$address', '$registration_number', '$program')";

    $success = mysqli_query($conn, $insert_query);

    if (!$success) {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

if ($success) {
    $display = "Student added successfully. Registration Number: $registration_number";
} else {
    $display = $error_message; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- <link rel="stylesheet" href="add_student.css"> -->
     <style>
        *{
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
            color: #FFF;
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

        button {
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

        button:hover {
            background-color: #303f84;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #1E2A5E;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        tr:nth-child(even){
            background: #e7f6ff;
        }

     </style>
</head>
<body>

<h1>Add Student</h1>
<form method="POST" action="add_student.php">
    <p><?php if(isset($display)){ echo $display; } ?></p>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="session">Session:</label>
    <select id="session" name="session" required>
        <option value="2021-2025">2021-2025</option>
        <option value="2022-2026">2022-2026</option>
        <option value="2023-2027">2023-2027</option>
        <option value="2024-2028">2024-2028</option>
        <option value="2025-2029">2025-2029</option>
    </select>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>

    <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea>

    <label for="program">Program:</label>
    <select id="program" name="program" required>
        <option value="BSc. SE">BSc. SE</option>
        <option value="MSc. SE">MSc. SE</option>
        <option value="MPhil. SE">MPhil. SE</option>
    </select>

    <button type="submit">Add Student</button>
</form>

</body>
</html>
