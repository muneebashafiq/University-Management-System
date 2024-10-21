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

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM courses WHERE id='$id'";
    
    if (mysqli_query($conn, $delete_query)) {
        $message = "Record deleted successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $pre_requisite = $_POST['pre_requisite'];
    $credits = $_POST['credits'];

    $update_query = "UPDATE courses SET course_name='$course_name', course_code='$course_code', pre_requisite='$pre_requisite', credits='$credits' WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        $message = "Record updated successfully";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Fetch faculty details for editing
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM courses WHERE id='$id'";
    $edit_result = mysqli_query($conn, $edit_query);
    $edit_data = mysqli_fetch_assoc($edit_result);
}

// Query to fetch all faculty members
$query = "SELECT id, course_name, course_code, pre_requisite, credits  FROM courses";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Courses</title>
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
        .button.dlt {
            background-color: #ff5a4e;
        }
        
        a{
            text-decoration: none;
            margin-right: 5px;
        }

    </style>
</head>
<body>

<h1>Registered Courses</h1>

<p><?php if (isset($message)) { echo $message; } ?></p>

<!-- Display the faculty data  -->
<form method="POST" action="view_courses.php">
    <table>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Pre Requisite</th>
            <th>credits</th>
            <th>Actions</th>
        </tr>

        <?php
        // Check if there are any results from the query
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";

                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='course_name' value='" . $edit_data['course_name'] . "' required>";
                } else {
                    echo $row['course_name'];
                }
                echo "</td>";

                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='course_code' value='" . $edit_data['course_code'] . "' required>";
                } else {
                    echo $row['course_code'];
                }
                echo "</td>";

                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='text' name='pre_requisite' value='" . $edit_data['pre_requisite'] . "' required>";
                } else {
                    echo $row['pre_requisite'];
                }
                echo "</td>";

                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='number' name='credits' value='" . $edit_data['credits'] . "' required>";
                } else {
                    echo $row['credits'];
                }
                echo "</td>";

                echo "<td>";
                if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='submit' name='update' value='Update' class='button edit'>";
                } else {
                    echo "<form method='POST' action='view_courses.php' style='display:inline;'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<a href='view_courses.php?edit_id=" . $row['id'] . "' class='button'>Edit</a>";
                    echo "<input type='submit' name='delete' value='Delete' class='button dlt' onclick='return confirm(\"Are you sure you want to delete this record?\");'>";
                    echo "</form>";
                }
                echo "</td>";
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No faculty members registered.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</form>

</body>
</html>
