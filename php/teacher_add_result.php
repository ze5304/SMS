<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['usertype']!='teacher'){
    header("location:login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","schoolproject");
if(!$conn){
    die("DB Error");
}

/* students */
/* students (ADMIN ADDED) */
$students = mysqli_query($conn,"SELECT id, username FROM students");


/* courses */
$courses = mysqli_query($conn,"SELECT id, name FROM courses");


/* insert result */
if(isset($_POST['add_result'])){
    $student_id = $_POST['student_id'];
    $course_id  = $_POST['course_id'];
    $mark       = $_POST['mark'];

    $sql = "INSERT INTO result (student_id, course_id, mark)
            VALUES ('$student_id','$course_id','$mark')";

    mysqli_query($conn,$sql);
    header("location:teacher_add_result.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Result</title>
<?php include 'student_css.php'; ?>
</head>
<body>

<?php include 'teacher_sidebar.php'; ?>

<div class="main-content">
<h1>Add Student Result</h1>

<form method="POST">
    <label>Student</label><br>
    <select name="student_id" required>
        <option value="">Select Student</option>
        <?php while($s=mysqli_fetch_assoc($students)){ ?>
        <option value="<?= $s['id'] ?>"><?= $s['username'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Course</label><br>
    <select name="course_id" required>
        <option value="">Select Course</option>
        <?php while($c=mysqli_fetch_assoc($courses)){ ?>
        <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Mark</label><br>
    <input type="text" name="mark" required><br><br>

    <input type="submit" name="add_result" value="Add Result" class="btn btn-primary">
</form>
</div>

</body>
</html>
