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

// Handle delete request
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM students WHERE id='$id'";
    
    if (mysqli_query($conn, $delete_query)) {
        $message = "Record deleted successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Handle update request
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $session = $_POST['session'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $registration_number = $_POST['registration_number'];
    $program = $_POST['program'];

    $update_query = "UPDATE students SET name='$name', email='$email', phone='$phone', session='$session', gender='$gender', address='$address', registration_number='$registration_number', program='$program' WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        $message = "Record updated successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Fetch student details for editing
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM students WHERE id='$id'";
    $edit_result = mysqli_query($conn, $edit_query);
    $edit_data = mysqli_fetch_assoc($edit_result);
}

// Query to fetch all students
$students_query = "SELECT id, name, email, phone, session, gender, address, registration_number, program FROM students";
$students_result = mysqli_query($conn, $students_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students</title>
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
        a{
            text-decoration: none;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            font-size: 20px;
        }
        table th, table td {
            padding: 20px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #303f84;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        table td {
            color: #555;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }

        table, th, td {
            border-left: none;
            border-right: none;
        }

        table td {
            border-bottom: 1px solid #ddd;
        }

        table tr {
            margin-bottom: 10px;
        }
        .button {
            background-color: #1E2A5E;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .button:hover {
            background-color: #303f84;
        }

        .button.dlt{
            background-color: #ff5a4e;
        }
    </style>
</head>
<body>

<h1>Registered Students</h1>

<p><?php if (isset($message)) { echo $message; } ?></p>

<form method="POST" action="view_students.php">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Session</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Registration Number</th>
            <th>Program</th>
            <th>Actions</th>
        </tr>

        <?php

        // Check if there are any results from the query
        if (mysqli_num_rows($students_result) > 0) {
            while ($row = mysqli_fetch_assoc($students_result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='name' value='" . $edit_data['name'] . "' required>";
                } else {
                    echo $row['name'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='email' name='email' value='" . $edit_data['email'] . "' required>";
                } else {
                    echo $row['email'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='phone' value='" . $edit_data['phone'] . "' required>";
                } else {
                    echo $row['phone'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='session' value='" . $edit_data['session'] . "' required>";
                } else {
                    echo $row['session'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='gender' value='" . $edit_data['gender'] . "' required>";
                } else {
                    echo $row['gender'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='address' value='" . $edit_data['address'] . "' required>";
                } else {
                    echo $row['address'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='registration_number' value='" . $edit_data['registration_number'] . "' required>";
                } else {
                    echo $row['registration_number'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='program' value='" . $edit_data['program'] . "' required>";
                } else {
                    echo $row['program'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='submit' name='update' value='Update' class='button edit'>";
                } else {
                    echo "<form method='POST' action='view_students.php' style='display:inline;'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<a href='view_students.php?edit_id=" . $row['id'] . "' class='button'>Edit</a>";
                    echo "<input type='submit' name='delete' value='Delete' class='button dlt' onclick='return confirm(\"Are you sure you want to delete this record?\");'>";
                    echo "</form>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No students registered.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</form>

</body>
</html>
