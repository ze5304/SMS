<?php
session_start();
error_reporting(0);
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
$SQL="SELECT *from admission";
$result=mysqli_query($data,$SQL);

if($_GET['teacher_id']){
    $t_id=$_GET['teacher_id'];
    $sql=" select * from teacher where id='$t_id'";
    $result=mysqli_query($data,$sql);
    $info=$result->fetch_assoc();
} 
 if(isset($_POST['update_teacher_btn'])){

    $id = $_POST['id'];
    $t_name = $_POST['name'];
    $t_des = $_POST['description'];

    if(!empty($_FILES['image']['name'])){
        $file = $_FILES['image']['name'];
        $dst = "image/".$file;
        move_uploaded_file($_FILES['image']['tmp_name'], $dst);

        $sql2 = "UPDATE teacher 
                 SET name='$t_name', description='$t_des', image='$dst'
                 WHERE id='$id'";
    } else {
        $sql2 = "UPDATE teacher 
                 SET name='$t_name', description='$t_des'
                 WHERE id='$id'";
    }

    $result2 = mysqli_query($data, $sql2);

    if($result2){
        header("location:admin_view_teatcher.php");
        exit();
    } else {
        echo "Update failed: " . mysqli_error($data);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_update_teacher</title>
      
      <?php
     include'admin_css.php';
       ?>
       <style>
       label{
        display: inline-block;
        width: 150px;
        text-align:right;
        padding-top:10px;
        padding-bottom:10px;

       } 
       .form_deg{
        background-color:skyblue;
        width: 600px;
        padding-top:70px;
        padding-bottom:70px;
       }
       </style>

</head>
<body>
<?php
 include'admin_sidebar.php';

?> 

   <div class="main-content">
    <center> <h1>Update teacher data</h1>
     <form class="form_deg" action="admin_update_teatcher.php" method="POST"
      enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

      
     <div>
        <label>teacher name</label>
        <input type="text" name="name" value="<?php 
        echo "{$info['name']}"
        ?>">
      </div>
      <div>
        <label>about teacher</label>
        <textarea name="description" rows="4"><?php 
        echo "{$info['description']}"
        ?> 
        </textarea>
      </div>
        <div>
        <label>teacher old image</label>
<?php
if(!empty($info['image'])){
    echo "<img src='uploads/".$info['image']."' width='120'>";
}
?>


      </div>
        <div>
        <label>choose Teacher naw image</label>
        <input type="file" name="image">

      </div>
        <div>
      
     <input class="btn btn-success" type="submit" 
       name="update_teacher_btn" value="Update">    
      </div>


     </form>
   
       </center>
   </div>
</body>
</html>