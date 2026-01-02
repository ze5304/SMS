<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}
elseif($_SESSION['usertype']=='student'){
    header("location:login.php");
    exit();
}

/* ===== DATABASE CONNECTION ===== */
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data = mysqli_connect($host,$user,$password,$db);
if(!$data){
    die("Database connection failed");
}

/* ===== DASHBOARD COUNTS ===== */

// Admissions
$admission = mysqli_fetch_assoc(
    mysqli_query($data,"SELECT COUNT(*) AS total FROM admission")
)['total'];

// Students
$students = mysqli_fetch_assoc(
    mysqli_query($data,"SELECT COUNT(*) AS total FROM students")
)['total'];

// Teachers (teacher table)
$teachers = mysqli_fetch_assoc(
    mysqli_query($data,"SELECT COUNT(*) AS total FROM teacher")
)['total'];

// Courses
$courses = mysqli_fetch_assoc(
    mysqli_query($data,"SELECT COUNT(*) AS total FROM courses")
)['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <?php include 'admin_css.php'; ?>

    <style>
        .dashboard-box{
            display:flex;
            gap:20px;
            flex-wrap:wrap;
            margin-top:30px;
        }
        .box{
            background:white;
            width:200px;
            padding:20px;
            text-align:center;
            box-shadow:0 0 10px #ccc;
            border-radius:8px;
        }
        .box h2{
            font-size:36px;
            color:#1abc9c;
            margin:10px 0;
        }
        .box p{
            font-size:18px;
            color:#333;
        }
    </style>
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

<div class="main-content">

    <center><h1>Admin Dashboard</h1></center>

    <!-- ===== DASHBOARD COUNTERS ===== -->
    <div class="dashboard-box">

        <div class="box">
            <p>Admissions</p>
            <h2><?php echo $admission; ?></h2>
        </div>

        <div class="box">
            <p>Students</p>
            <h2><?php echo $students; ?></h2>
        </div>

        <div class="box">
            <p>Teachers</p>
            <h2><?php echo $teachers; ?></h2>
        </div>

        <div class="box">
            <p>Courses</p>
            <h2><?php echo $courses; ?></h2>
        </div>

    </div>

</div>

</body>
</html>
