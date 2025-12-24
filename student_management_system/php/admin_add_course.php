   <?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='student'){
   header("location:login.php");
   
}
  $host="localhost";
   $user="root";
   $password="";
 $db="schoolproject";
$data=mysqli_connect($host,$user,$password,$db);
$sql="SELECT *from courses";

if(isset($_POST['add_course'])){
    $c_name=$_POST['name'];

     $c_description=$_POST['description'];
     $file_name = $_FILES['image']['name'];
$tmp_name  = $_FILES['image']['tmp_name'];

$dst = "image/".$file_name;        // php/image/filename.jpg
$dst_db = "php/image/".$file_name; // for index.php

move_uploaded_file($tmp_name, $dst);

$sql = "INSERT INTO courses (name, description, image)
        VALUES ('$c_name', '$c_description', '$dst_db')";

   $result = mysqli_query($data, $sql);
   if($result){
    header('location:admin_add_course.php');
   }


}
?>

  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Add Courses</title>
    <?php include 'admin_css.php'; ?>
    <style>
        .div_deg{
            background-color: skyblue;
            width: 500px;
            padding: 70px 0;
            margin: auto;
        }
        label {
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
<?php include 'admin_sidebar.php'; ?>

<div class="main-content">
    <center>
        <h1>Admin Add Course</h1><br>
        <div class="div_deg">
            <form action="admin_add_course.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label>Course Name</label>
                    <input type="text" name="name">
                </div><br>
                <div>
                    <label>Description</label>
                    <textarea name="description"></textarea>
                </div><br>
                <div>
                    <label>Image</label>
                    <input type="file" name="image">
                </div><br><br>
                <div>
                    <input type="submit" class="btn btn-primary" name="add_course" value="Add Course">
                </div>
            </form>
        </div>
    </center>
</div>
 
</body>
</html>

