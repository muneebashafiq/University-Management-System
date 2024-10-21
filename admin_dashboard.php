<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universitysystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

// Fetch admin details
$admin_id = $_SESSION['admin_id'];
$query = "SELECT name, email, profile_picture FROM admin WHERE id = '$admin_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $admin = mysqli_fetch_assoc($result);
    $admin_name = $admin['name'];
    $admin_email = $admin['email'];
    $profile_picture = $admin['profile_picture'] ? $admin['profile_picture'] : 'profile.jpg'; 
} else {
    echo "Admin not found!";
    exit;
}

// Close the connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="profile">
            <img src="<?php echo $profile_picture; ?>" alt="Profile Picture">
            <h3><?php echo $admin_name; ?></h3>
            <p>University Admin</p>
        </div>

        <ul class="view-btns">
            <li><a href="view_students.php">Registered Students</a></li>
            <li><a href="view_faculty.php">Registered Faculty</a></li>
            <li><a href="view_courses.php">Registered Courses</a></li>
            <li><a href="view_allocated_courses.php">Allocated Courses</a></li>
        </ul>

    </div>
    <div class="main-content">
        <header>
            <h1>Welcome to Your Dashboard, <?php echo $admin_name; ?>!</h1>
            <a href="index.php" class="logout-btn">Logout</a>
        </header>

        <div class="dashboard-options">
            <h2>Manage Your University System</h2>
            <div class="options-add">
                <a href="add_student.php" class="btn"><i class="fa-solid fa-school"></i>Add Student</a>
                <a href="add_faculty.php" class="btn"><i class="fa-solid fa-chalkboard-user"></i>Add Faculty</a>
                <a href="add_course.php" class="btn"><i class="fa-solid fa-book"></i>Add Course</a>
                <a href="allocate_course.php" class="btn"><i class="fa-solid fa-book-open-reader"></i>Allocate Course</a>
            </div>
        </div>
    </div>
</body>
</html>
