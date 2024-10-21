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

// Handle delete functionality
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM allocated_courses WHERE id='$id'";

    if (mysqli_query($conn, $delete_query)) {
        $message = "Record deleted successfully";
        header('Location: view_allocated_courses.php');
        exit;
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Handle update functionality
if (isset($_POST['update'])) {
    // Debug to check the POST values
    var_dump($_POST);  

    $id = $_POST['id'];
    $course_id = $_POST['course_id'];
    $student_id = $_POST['student_id'];
    $faculty_id = $_POST['faculty_id'];
    $semester = $_POST['semester'];
    $session = $_POST['session'];

    // SQL Update query
    $update_query = "UPDATE allocated_courses SET course_id='$course_id', student_id='$student_id', faculty_id='$faculty_id', semester='$semester', session='$session' WHERE id='$id'";

    // Execute query and check for errors
    if (mysqli_query($conn, $update_query)) {
        echo "Update successful!";  // Debug to check if the update was successful
        header('Location: view_allocated_courses.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);  // Output the error if the query fails
    }
}

// Fetch data for editing
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $edit_query = "SELECT * FROM allocated_courses WHERE id='$id'";
    $edit_result = mysqli_query($conn, $edit_query);
    $edit_data = mysqli_fetch_assoc($edit_result);
}

// Query to fetch allocated courses with details
$query = "
    SELECT
        ca.id,
        ca.session,
        ca.semester,
        c.id AS course_id,
        c.course_name,
        s.id AS student_id,
        s.name AS student_name,
        f.id AS faculty_id,
        f.name AS faculty_name
    FROM
        allocated_courses ca
    JOIN
        courses c ON ca.course_id = c.id
    JOIN
        students s ON ca.student_id = s.id
    JOIN
        faculty f ON ca.faculty_id = f.id
    ORDER BY
        ca.session, ca.semester, c.course_name, s.name
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocated Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
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
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #303f84;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .button {
            background-color: #1E2A5E;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #303f84;
        }
        .button.dlt {
            background-color: #ff5a4e;
            font-size: 16px;
        }
        a{
            text-decoration: none;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<h1>Allocated Courses</h1>

<p><?php if (isset($message)) { echo $message; } ?></p>

<!-- Display table with allocated courses -->
<form method="POST">
    <table>
        <thead>
            <tr>
                <th>Session</th>
                <th>Semester</th>
                <th>Course Name</th>
                <th>Student Name</th>
                <th>Faculty Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    
                    echo "<td>";
                    if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                        echo "<input type='text' name='session' value='" . $edit_data['session'] . "' required>";
                    } else {
                        echo $row['session'];
                    }
                    echo "</td>";

                    echo "<td>";
                    if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                        echo "<input type='text' name='semester' value='" . $edit_data['semester'] . "' required>";
                    } else {
                        echo $row['semester'];
                    }
                    echo "</td>";

                    echo "<td>";
                    if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                        echo "<select name='course_id'>";
                        $courses_query = "SELECT * FROM courses";
                        $courses_result = mysqli_query($conn, $courses_query);
                        while ($course = mysqli_fetch_assoc($courses_result)) {
                            $selected = ($course['id'] == $row['course_id']) ? "selected" : "";
                            echo "<option value='" . $course['id'] . "' $selected>" . $course['course_name'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo $row['course_name'];
                    }
                    echo "</td>";

                    echo "<td>";
                    if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                        echo "<select name='student_id'>";
                        // Fetch and populate the student dropdown
                        $students_query = "SELECT * FROM students";
                        $students_result = mysqli_query($conn, $students_query);
                        while ($student = mysqli_fetch_assoc($students_result)) {
                            $selected = ($student['id'] == $row['student_id']) ? "selected" : "";
                            echo "<option value='" . $student['id'] . "' $selected>" . $student['name'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo $row['student_name'];
                    }
                    echo "</td>";

                    echo "<td>";
                    if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                        echo "<select name='faculty_id'>";
                        $faculty_query = "SELECT * FROM faculty";
                        $faculty_result = mysqli_query($conn, $faculty_query);
                        while ($faculty = mysqli_fetch_assoc($faculty_result)) {
                            $selected = ($faculty['id'] == $row['faculty_id']) ? "selected" : "";
                            echo "<option value='" . $faculty['id'] . "' $selected>" . $faculty['name'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo $row['faculty_name'];
                    }
                    echo "</td>";

                    echo "<td>";
                    if (isset($edit_data) && $edit_data['id'] == $row['id']) {
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' name='update' value='Update' class='button'>";
                    } else {
                        echo "<form method='POST' action='view_allocated_courses.php' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<a href='view_allocated_courses.php?edit_id=" . $row['id'] . "' class='button'>Edit</a>";
                        echo "<input type='submit' name='delete' value='Delete' class='button dlt' onclick='return confirm(\"Are you sure you want to delete this record?\");'>";
                        echo "</form>";
                    }
                    echo "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</form>

</body>
</html>
