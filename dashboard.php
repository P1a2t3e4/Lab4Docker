<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'student_course_system');
$student_id = $_SESSION['student_id'];

$enrollments = $conn->query("SELECT courses.title FROM enrollments 
    JOIN courses ON enrollments.course_id = courses.id 
    WHERE enrollments.student_id = '$student_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Your Courses</h2>
        <ul>
            <?php while ($course = $enrollments->fetch_assoc()) { ?>
                <li><?php echo $course['title']; ?></li>
            <?php } ?>
        </ul>
        <a href="courses.php" class="btn">View More Courses</a>
    </div>
</body>
</html>
