<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}

if($_SESSION['usertype']=='student'){
   header("location:login.php");
   exit();
}

$data = mysqli_connect("localhost","root","","schoolproject");

if(!isset($_GET['student_id'])){
    header("location:view_student.php");
    exit();
}

$id = $_GET['student_id'];

$SQL = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($data,$SQL);
$info = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];   
    $password = $_POST['password'];

    $query = "UPDATE user 
              SET username='$name',
                  email='$email',
                  phone='$phone',
                  password='$password'
              WHERE id='$id'";

    $result2 = mysqli_query($data,$query);

    if($result2){
        header("location:veiw_student.php");
        echo "<script>alert('Update is successful');</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
        echo mysqli_error($data); 
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
        label{
            display:inline-block;
            width: 100px;
            text-align:right;
            padding-top:10px;
             padding-bottom:10px;

        }
     .div_deg{
        background-color:skyblue;
        width: 400px;
        padding-top:70px;
        padding-bottom:70px;
     }
        
       </style>

</head>
<body>
<?php
 include'admin_sidebar.php';

?> 
<center>
   <div class="main-content">
    <center> <h1>update student</h1> </center>
     <div class="div_deg">
         <center>
        <form action="" method="post">
            <div>
                <label>username:</label>
                <input type="text" name="name" value="<?php
                 echo "{$info['username']}";  ?>">
            </div>
             <div>
                <label>email:</label>
                <input type="text" name="email" value="<?php
                 echo "{$info['email']}";?>">
            </div>
             <div>
                <label>phone:</label>
                <input type="number" name="phone" value="<?php
                 echo "{$info['phone']}";?>">
            </div>
             <div>
                <label>password:</label>
                <input type="text" name="password" value="<?php
                 echo "{$info['password']}";?>">
            </div>
           
                <input class="btn btn-success" type="submit" name="update" value="Update">
            </div>
        </form>
       </center>
     </div>
   
      
   </div>
    </center>
</body>
</html>