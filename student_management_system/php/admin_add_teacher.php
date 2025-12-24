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
$sql = "SELECT * FROM teacher";


if(isset($_POST['add_teacher'])){
    $t_name=$_POST['name'];

     $t_description=$_POST['description'];
     $file_name = $_FILES['image']['name'];
$tmp_name  = $_FILES['image']['tmp_name'];

$dst = "image/".$file_name;          // upload path
$dst_db = "php/image/".$file_name;   // path for index.php

move_uploaded_file($tmp_name, $dst);

$sql = "INSERT INTO teacher (name, description, image)
        VALUES ('$t_name', '$t_description', '$dst_db')";

   $result = mysqli_query($data, $sql);
   if($result){
    header('location:admin_add_teacher.php');
   }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student dashboard</title>
      
      <?php
     include'admin_css.php';
       ?>
       <style>
        .div_deg{
            background-color:skyblue;
            width: 500px;
            padding-bottom:70px;
            padding-top:70px:
        }
       </style>

</head>
<body>
<?php
 include'admin_sidebar.php';

?> 

   <div class="main-content">
    <center> 
        <h1>Admin are add teacher</h1><br>
  <div class="div_deg">
  <form action="" method="POST" enctype="multipart/form-data">
    <div>
    <label style="margin-top:20px">teacher name</label>
    <input type="text" name="name" value="">
    </div><br>
     <div>
    <label>Description</label>
    <textarea name="description"></textarea>
    </div><br>
     <div>
    <label>Image</label>
    <input type="file" name="image" value="">
    </div>
    <br><br>
     <div>
   
    <input type="submit" class="btn btn-primary" name="add_teacher" value="Add teacher">
    </div>
  </form>
  </div>


   </center>
     
   
      
   </div>
   
</body>
</html>