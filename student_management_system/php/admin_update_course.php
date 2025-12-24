<?php
session_start();
error_reporting(0);

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

// GET course data
if(isset($_GET['course_id'])){
    $c_id = $_GET['course_id'];
    $sql = "SELECT * FROM courses WHERE id='$c_id'";
    $result = mysqli_query($data,$sql);
    $info = $result->fetch_assoc();
}

// UPDATE course
if(isset($_POST['update_course_btn'])){

    $id   = $_POST['id'];
    $name = $_POST['name'];
    $des  = $_POST['description'];

    // if new image selected
    if(!empty($_FILES['image']['name'])){
        $file = $_FILES['image']['name'];
        $dst  = "image/".$file;           // real upload
        $db_path = "php/image/".$file;    // store in DB

        move_uploaded_file($_FILES['image']['tmp_name'], $dst);

        $sql2 = "UPDATE courses 
                 SET name='$name', description='$des', image='$db_path'
                 WHERE id='$id'";
    } 
    // if image not changed
    else {
        $sql2 = "UPDATE courses 
                 SET name='$name', description='$des'
                 WHERE id='$id'";
    }

    $result2 = mysqli_query($data,$sql2);

    if($result2){
        header("location:admin_view_course.php");
        exit();
    } else {
        echo "Update failed: ".mysqli_error($data);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Course</title>

    <?php include 'admin_css.php'; ?>

    <style>
        label{
            display:inline-block;
            width:160px;
            text-align:right;
            padding:10px;
        }
        .form_deg{
            background-color:skyblue;
            width:600px;
            padding:60px;
        }
    </style>
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

<div class="main-content">
<center>
    <h1>Update Course Data</h1><br>

    <form class="form_deg" action="admin_update_course.php" 
          method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

        <div>
            <label>Course Name</label>
            <input type="text" name="name" 
                   value="<?php echo $info['name']; ?>">
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" rows="4"><?php 
                echo $info['description']; 
            ?></textarea>
        </div>

        <div>
            <label>Old Image</label>
            <?php if(!empty($info['image'])){ ?>
                <img src="../<?php echo $info['image']; ?>" width="120">
            <?php } ?>
        </div>

        <div>
            <label>New Image</label>
            <input type="file" name="image">
        </div>

        <div>
            <input class="btn btn-success" type="submit"
                   name="update_course_btn" value="Update Course">
        </div>

    </form>
</center>
</div>

</body>
</html>
