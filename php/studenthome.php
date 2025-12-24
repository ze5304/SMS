<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
   header("location:login.php");
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student dashboard</title>
    <?php
     include'student_css.php';
       ?>
 
</head>
<body>
  <?php
     include'sudent_sidvar.php';
       ?>

   <div class="main-content">
    <h1>student home</h1>
    
       
   </div>
</body>
</html>