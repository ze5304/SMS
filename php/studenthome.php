<?php
session_start();

/* ===== CHECK STUDENT LOGIN ===== */
if(
    !isset($_SESSION['student_id']) ||
    !isset($_SESSION['usertype']) ||
    $_SESSION['usertype'] != 'student'
){
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <?php include 'student_css.php'; ?>
</head>
<body>

<?php include 'student_sidebar.php'; ?>

<div class="main-content">
    <h1>Student Home</h1>
</div>

</body>
</html>
