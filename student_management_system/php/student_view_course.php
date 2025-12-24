<?php
session_start();
error_reporting(0);

// student login check
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
    exit();
}

// DB connection
$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data = mysqli_connect($host,$user,$password,$db);

// fetch courses
$sql = "SELECT * FROM courses";
$result = mysqli_query($data,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student View Courses</title>

    <?php include 'student_css.php'; ?>

    <style>
        .course-box{
            background:#f2f2f2;
            padding:15px;
            margin:15px;
            border-radius:8px;
            text-align:center;
        }
        .course-box img{
            width:200px;
            height:130px;
            object-fit:cover;
            border-radius:6px;
        }
    </style>
</head>
<body>

<?php include 'sudent_sidvar.php'; ?>

<div class="main-content">
    <h1>Available Courses</h1>
    <br>

    <div class="row">
        <?php while($info = $result->fetch_assoc()){ ?>
            <div class="col-md-4">
                <div class="course-box">
                    <img src="../<?php echo $info['image']; ?>" alt="course image">
                    <h3><?php echo $info['name']; ?></h3>
                    <p><?php echo $info['description']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
