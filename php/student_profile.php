<?php
session_start();

if(!isset($_SESSION['student_id'])){
    header("location:login.php");
    exit();
}

if($_SESSION['usertype'] != 'student'){
    header("location:login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","schoolproject");

$student_id = $_SESSION['student_id'];

/* ===== FETCH PROFILE ===== */
$sql = "SELECT * FROM students WHERE id='$student_id'";
$result = mysqli_query($conn,$sql);
$info = mysqli_fetch_assoc($result);

if(!$info){
    echo "Profile not found";
    exit();
}

/* ===== UPDATE PROFILE ===== */
if(isset($_POST['update_profile'])){

    $username = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];

    $update = "UPDATE students SET
               username='$username',
               email='$email',
               phone='$phone',
               password='$password'
               WHERE id='$student_id'";

   if(mysqli_query($conn,$update)){
    $_SESSION['username'] = $username; // update session
    header("location:studenthome.php");
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
include 'student_sidebar.php';
?>

       <div class="main-content">
        <center>
            <h1>Student Update profile </h1>
            <br><br>
      <form method="POST">
<div class="div_deg">

<div>
<label>Name</label>
<input type="text" name="name" value="<?= $info['username']; ?>">
</div>

<div>
<label>Email</label>
<input type="email" name="email" value="<?= $info['email']; ?>">
</div>

<div>
<label>Phone</label>
<input type="number" name="phone" value="<?= $info['phone']; ?>">
</div>

<div>
<label>Password</label>
<input type="text" name="password" value="<?= $info['password']; ?>">
</div>

<div>
<input type="submit" name="update_profile" class="btn btn-primary" value="Update Profile">
</div>

</div>
</form>

       </center>
       </div>

   
</body>
</html>