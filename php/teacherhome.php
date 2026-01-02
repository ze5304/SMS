<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}
elseif($_SESSION['usertype'] != 'teacher'){
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    <?php
    include 'student_css.php'; 
    // እስታይል student ጋር አንድ ነው
    ?>
</head>
<body>

<?php
include 'teacher_sidebar.php';
?>

<div class="main-content">
    <h1>Teacher Home</h1>
</div>

</body>
</html>
