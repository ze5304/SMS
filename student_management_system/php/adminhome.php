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
$SQL="SELECT *from admission";
$result=mysqli_query($data,$SQL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin home</title>
      
      <?php
     include'admin_css.php';
       ?>

</head>
<body>
<?php
 include'admin_sidebar.php';

?> 

   <div class="main-content">
    <center> <h1>Admin  Dashboard</h1> </center>
     
   
      
   </div>

      <?php
     include'admin_footer.php';
       ?>

</body>
</html>