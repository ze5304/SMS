<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

if ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "schoolproject");

if (isset($_POST['add_student'])) {

    $username = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];
    $usertype = "student";

    // check username
    $check = "SELECT * FROM user WHERE username='$username'";
    $check_user = mysqli_query($conn, $check);
    $row_count = mysqli_num_rows($check_user);

    if ($row_count > 0) {

        echo "<script>alert('Username already exists. Try another one');</script>";

    } else {

        $sql = "INSERT INTO user (username, email, phone, usertype, `password`)
                VALUES ('$username', '$email', '$phone', '$usertype', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data upload success');</script>";
        } else {
            echo "<script>alert('Data upload failed');</script>";
        }
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
  
        display: inline-block;
        text-align:right;
        width: 100px;
        padding-top:10px;
        padding-bottom:10px;

    }
    .div_deg{
        background-color: skyblue;
        width: 400px;
       padding-top: 70px;
        padding-bottom: 70px; 
    }

       </style>

</head>
<body>
<?php
 include'admin_sidebar.php';

?> 

   <div class="main-content">
    <center> <h1>Add  student</h1> <br><br>
    <div class="div_deg">
        <form action="#" method="post">
            <div>
      <label >username</label>
      <input type="text" name="name">
      </div>
      <div>
      <label >emaile</label>
      <input type="text" name="email">
      </div>
        <div>
     <label >phone</label>
      <input type="number" name="phone">
      </div>
      <div>
     <label >password</label>
      <input type="text" name="password">
      </div>
      <div>
        <input type="submit" class="btn btn-primary "  name="add_student" value="Add Student">
      </div>
        </form>
    </div>

  
     </center>
     
   
      
   </div>
</body>
</html>