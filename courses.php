<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'student_course_system');
$courses = $conn->query("SELECT * FROM courses");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $student_id = $_SESSION['student_id'];

    $conn->query("INSERT INTO enrollments (student_id, course_id) VALUES ('$student_id', '$course_id')");
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Courses</h2>
        <ul>
            <?php while ($course = $courses->fetch_assoc()) { ?>
                <li>
                    <strong><?php echo $course['title']; ?></strong><br>
                    <p><?php echo $course['description']; ?></p>
                    <form method="POST" action="">
                        <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                        <button type="submit" class="btn">Enroll</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
