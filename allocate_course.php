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

// Handle form submission for course allocation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $session = $_POST['session'];
    $semester = $_POST['semester'];
    $course_id = $_POST['course'];
    $students = json_decode($_POST['students'], true); 
    $faculty_id = $_POST['faculty'];
    
    // Validate that at least one student is selected
    if (!empty($students) && is_array($students)) {
        foreach ($students as $student) {
            $student_name = mysqli_real_escape_string($conn, $student['name']);
            $student_reg_number = mysqli_real_escape_string($conn, $student['regNumber']);
            
            // Fetch student ID based on name and registration number
            $student_query = "SELECT id FROM students WHERE name='$student_name' AND registration_number='$student_reg_number'";
            $student_result = mysqli_query($conn, $student_query);
            
            if (mysqli_num_rows($student_result) > 0) {
                $student_row = mysqli_fetch_assoc($student_result);
                $student_id = $student_row['id'];

                // Insert allocation data into the database
                $query = "INSERT INTO allocated_courses (session, semester, course_id, student_id, faculty_id)
                          VALUES ('$session', '$semester', '$course_id', '$student_id', '$faculty_id')";
                
                if (!mysqli_query($conn, $query)) {
                    $message = "Error: " . mysqli_error($conn);
                    break;
                } else {
                    $message = "Course allocated successfully!";
                }
            } else {
                $message = "Student not found: $student_name - $student_reg_number";
                break;
            }
        }
    } else {
        $message = "No students provided.";
    }
}

// Fetch available courses, students (with registration number), and faculty (with department) for selection
$courses_query = "SELECT id, course_name FROM courses";
$courses_result = mysqli_query($conn, $courses_query);

$students_query = "SELECT id, name, registration_number FROM students";
$students_result = mysqli_query($conn, $students_query);

$faculty_query = "SELECT id, name, department FROM faculty";
$faculty_result = mysqli_query($conn, $faculty_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocate Courses</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: #f4f4f4; 
            width: 100%;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            background: #1E2A5E;
            color: white;
            display: block;
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
        input.button {
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
        input.button:hover {
            background-color: #303f84;
        }

        button{
            background-color: #1E2A5E;
            color: #fff;
            border: none;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: -10px;
            margin-bottom: 20px;
        }
        button:hover{
            background-color: #303f84;
        }
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .student-item {
            margin-bottom: 10px;
        }
        .message {
            color: green;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>Allocate Courses</h1>

<?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>

<form id="allocationForm" method="POST" action="">
    <label for="session">Session:</label>
    <select name="session" id="session" required>
        <option value="2021-2025">2021-2025</option>
        <option value="2022-2026">2022-2026</option>
        <option value="2023-2027">2023-2027</option>
        <option value="2024-2028">2024-2028</option>
        <option value="2025-2029">2025-2029</option>
    </select>

    <label for="semester">Semester:</label>
    <select name="semester" id="semester" required>
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
    </select>

    <label for="course">Course:</label>
    <select name="course" id="course" required>
        <?php
        if (mysqli_num_rows($courses_result) > 0) {
            while ($row = mysqli_fetch_assoc($courses_result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['course_name'] . "</option>";
            }
        }
        ?>
    </select>

    <label for="studentsSelect">Add Students (Name - Registration Number):</label>
    <div id="studentList"></div>
    <select name="studentsSelect" id="studentsSelect">
        <?php
        if (mysqli_num_rows($students_result) > 0) {
            while ($row = mysqli_fetch_assoc($students_result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . " - " . $row['registration_number'] . "</option>";
            }
        }
        ?>
    </select>
    <button type="button" onclick="addStudent()">Add Student</button>

    <input type="hidden" name="students" id="studentsHidden" required>

    <label for="faculty">Faculty (Name - Department):</label>
    <select name="faculty" id="faculty" required>
        <?php
        if (mysqli_num_rows($faculty_result) > 0) {
            while ($row = mysqli_fetch_assoc($faculty_result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . " - " . $row['department'] . "</option>";
            }
        }
        ?>
    </select>

    <input type="submit" value="Allocate Course" class="button">
</form>

<script>
    let studentList = [];

    function addStudent() {
        const selectedOption = document.getElementById('studentsSelect').selectedOptions[0];
        const name = selectedOption.text.split(' - ')[0];
        const regNumber = selectedOption.text.split(' - ')[1];

        if (name && regNumber) {
            const studentEntry = { name: name, regNumber: regNumber };
            studentList.push(studentEntry);
            updateStudentList();
            updateHiddenField();
        }
    }

    function updateStudentList() {
        const studentListDiv = document.getElementById('studentList');
        studentListDiv.innerHTML = '';
        studentList.forEach((student, index) => {
            studentListDiv.innerHTML += `<div class="student-item">${student.name} - ${student.regNumber} <button onclick="removeStudent(${index})">Remove</button></div>`;
        });
    }

    function removeStudent(index) {
        studentList.splice(index, 1);
        updateStudentList();
        updateHiddenField();
    }

    function updateHiddenField() {
        document.getElementById('studentsHidden').value = JSON.stringify(studentList);
    }
</script>

</body>
</html>

<?php
// Close the connection
mysqli_close($conn);
?>
