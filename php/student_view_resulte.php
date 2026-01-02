<?php
session_start();

/* ===== CHECK STUDENT LOGIN ===== */
if(
    !isset($_SESSION['student_id']) ||
    $_SESSION['usertype'] != 'student'
){
    header("location:login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","schoolproject");
if(!$conn){
    die("DB error");
}

$student_id = $_SESSION['student_id'];

/* ===== FETCH ONLY THIS STUDENT RESULTS ===== */
$sql = "SELECT 
            courses.name AS course_name,
            result.mark
        FROM result
        JOIN courses ON result.course_id = courses.id
        WHERE result.student_id = '$student_id'";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Results</title>
<?php include 'student_css.php'; ?>
</head>
<body>

<?php include 'student_sidebar.php'; ?>

<div class="main-content">
<h1>My Results</h1>

<table border="1" width="70%" cellpadding="10">
<tr>
    <th>Course</th>
    <th>Mark</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?= htmlspecialchars($row['course_name']); ?></td>
    <td style="text-align:center;font-weight:bold;">
        <?= htmlspecialchars($row['mark']); ?>
    </td>
</tr>
<?php
    }
}else{
?>
<tr>
    <td colspan="2" style="text-align:center;">
        No results available
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
