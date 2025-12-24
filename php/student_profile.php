<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}

if($_SESSION['usertype'] != 'student'){
    header("location:login.php");
    exit();
}

$data = mysqli_connect("localhost","root","","schoolproject");

$name = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username='$name'";
$result = mysqli_query($data,$sql);
$info = mysqli_fetch_assoc($result);

if(isset($_POST['update_profile'])){
    $s_name     = $_POST['name'];
    $s_email    = $_POST['email'];
    $s_phone    = $_POST['phone'];
    $s_password = $_POST['password'];

    $sql = "UPDATE user SET
            username='$s_name',
            email='$s_email',
            phone='$s_phone',
            password='$s_password'
            WHERE username='$name'";

    $result2 = mysqli_query($data,$sql);

    if($result2){
        header("location:student_profile.php");
        exit();
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
     include'student_css.php';
       ?>
       <style>
        label{
    display:inline-block;
    text-align:right;
    padding-top: 10px;
    padding-bottom: 10px;
    width: 100px;
        }
        .div_deg{
            background-color:skyblue;
            width: 500px;
            padding-top:70px;
            padding-bottom:70px;
        }
       </style>
 
</head>
<body>
  <?php
     include'sudent_sidvar.php';
       ?>
       <div class="main-content">
        <center>
            <h1>Student Update profile </h1>
            <br><br>
       <form action="" method="POST">
        <div class="div_deg">
        <div>
            <label>name</label>
            <input type="text" name="name" value="<?php
            echo "{$info['username']}"
            ?>">
        </div>
        <div>
            <label>email</label>
            <input type="email" name="email" value="<?php
            echo "{$info['email']}"?>">
        </div>
        <div>
            <label>phone</label>
            <input type="number" name="phone" value="<?php
            echo "{$info['phone']}"?>">
        </div>
        <div>
            <label>password</label>
            <input type="text" name="password" value="<?php
            echo "{$info['password']}"?>">
        </div>
        <div>
            <input type="submit" class="ntn btn-primary" name="update_profile" value="update">
        </div>
        </div>
       </form>
       </center>
       </div>

   
</body>
</html>