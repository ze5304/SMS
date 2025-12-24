<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}

if($_SESSION['usertype']=='student'){
   header("location:login.php");
   exit();
}

$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$data=mysqli_connect($host,$user,$password,$db);

$SQL="SELECT * FROM user";
$result=mysqli_query($data,$SQL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <?php include 'admin_css.php'; ?>
    <style>
        td{
            background-color:skyblue;
        }
    </style>    
      </head>
  <body>
    <?php include 'admin_sidebar.php'; ?> 

    <div class="main-content">
        <center>
            <h1>Student Data</h1>
<?php
     if($_SESSION['message']){
    echo   $_SESSION['message'];
}
unset(  $_SESSION['message']);
?>

            <br><br>
            <table border="1">
                <tr>
                    <th style="padding:20px; font-size:15px;">USERNAME</th>
                    <th style="padding:20px; font-size:15px;">Phone</th>
                    <th style="padding:20px; font-size:15px;">Email</th>
                    <th style="padding:20px; font-size:15px;">USERTYPE</th>
                     <th style="padding:20px; font-size:15px;">PASSWORD</th>
                     <th style="padding:20px; font-size:15px;">DELETE</th>
                     <th style="padding:20px; font-size:15px;">update</th>   
                </tr>

            <?php
while($info = mysqli_fetch_assoc($result)){
?>
<tr>
    <td style="padding:2px;"><?php echo $info['username']; ?></td>
    <td style="padding:2px;"><?php echo $info['phone']; ?></td>
    <td style="padding:2px;"><?php echo $info['email']; ?></td>
    <td style="padding:2px;"><?php echo $info['usertype']; ?></td>
    <td style="padding:2px;"><?php echo $info['password']; ?></td>
     <td style="padding:2px;"><?php echo " <a class='btn btn-danger' onclick=\"javascript:return confirm('Are you sure delete this');\" href='delete.php?student_id={$info['id']}'>delete</a>" ; 
     
     ?></td>
      <td style="padding:2px;"><?php echo "<a class='btn btn-primary' href='Updat_student.php?student_id={$info['id']}'>Update </a>"; ?></td>
</tr>
 
</tr>
<?php
}
?>

            </table>
        </center>
    </div>
</body>
</html>
