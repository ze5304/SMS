<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}
elseif($_SESSION['usertype']=='student'){
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

// delete course
if(isset($_GET['course_id'])){
    $c_id = $_GET['course_id'];

    $sql2 = "DELETE FROM courses WHERE id='$c_id'";
    $result2 = mysqli_query($data,$sql2);

    if($result2){
        header("location:admin_view_course.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Courses</title>

    <?php include 'admin_css.php'; ?>

    <style>
        .table_th{
            padding:20px;
            font-size:20px;
        }
        .table_td{
            padding:20px;
            background-color:skyblue;
            text-align:center;
        }
    </style>
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

<div class="main-content">
    <center>
        <h1>View All Course Data</h1><br>

        <table border="1px">
            <tr>
                <th class="table_th">Course Name</th>
                <th class="table_th">Description</th>
                <th class="table_th">Image</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
            </tr>

            <?php while($info = $result->fetch_assoc()){ ?>
            <tr>
                <td class="table_td">
                    <?php echo $info['name']; ?>
                </td>

                <td class="table_td">
                    <?php echo $info['description']; ?>
                </td>

                <td class="table_td">
                    <!-- IMPORTANT FIX -->
                    <img src="../<?php echo $info['image']; ?>" width="100">
                </td>

                <td class="table_td">
                    <a onclick="return confirm('Are you sure delete this course?');"
                       class="btn btn-danger"
                       href="admin_view_course.php?course_id=<?php echo $info['id']; ?>">
                       Delete
                    </a>
                </td>

                <td class="table_td">
                    <a onclick="return confirm('Are you sure update this course?');"
                       class="btn btn-primary"
                       href="admin_update_course.php?course_id=<?php echo $info['id']; ?>">
                       Update
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </center>
</div>

</body>
</html>
