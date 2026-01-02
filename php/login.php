<?php
session_start();
$conn = mysqli_connect("localhost","root","","schoolproject");

if(!$conn){
    die("Database connection error");
}

/* ================= LOGIN PROCESS ================= */
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* ===== 1️⃣ CHECK STUDENT ===== */
    $student_sql = "SELECT * FROM students 
                    WHERE username='$username' AND password='$password'";
    $student_res = mysqli_query($conn,$student_sql);

    if(mysqli_num_rows($student_res)==1){
        $student = mysqli_fetch_assoc($student_res);

        $_SESSION['student_id'] = $student['id'];   // ⭐ IMPORTANT
        $_SESSION['username']   = $student['username'];
        $_SESSION['usertype']   = 'student';

        header("location:studenthome.php");
        exit();
    }

    /* ===== 2️⃣ CHECK TEACHER / ADMIN ===== */
    $user_sql = "SELECT * FROM user 
                 WHERE username='$username' AND password='$password'";
    $user_res = mysqli_query($conn,$user_sql);

    if(mysqli_num_rows($user_res)==1){
        $user = mysqli_fetch_assoc($user_res);

        $_SESSION['username'] = $user['username'];
        $_SESSION['usertype'] = $user['usertype'];

        if($user['usertype'] == 'teacher'){
            header("location:teacherhome.php");
            exit();
        }
        elseif($user['usertype'] == 'admin'){
            header("location:adminhome.php");
            exit();
        }
    }

    /* ===== LOGIN FAILED ===== */
    $_SESSION['loginMessage'] = "Invalid username or password";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | Student Management System</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<style>
body{
    margin:0;
    padding:0;
    height:100vh;
    background:url("../school3.jpg") no-repeat center center/cover;
    font-family:Arial, sans-serif;
}
.overlay{
    width:100%;
    height:100vh;
    background:rgba(0,0,0,0.6);
}
.header{
    text-align:center;
    padding:30px 0;
    color:#fff;
    font-size:34px;
    font-weight:bold;
}
.center-box{
    display:flex;
    justify-content:center;
    align-items:center;
    height:calc(100vh - 120px);
}
.login-box{
    width:520px;
    padding:45px;
    background:rgba(255,255,255,0.18);
    backdrop-filter:blur(14px);
    border-radius:16px;
    box-shadow:0 0 30px rgba(0,0,0,0.7);
    color:#fff;
}
.login-box h2{
    text-align:center;
    font-size:28px;
    margin-bottom:30px;
    font-weight:bold;
}
.login-box input{
    width:100%;
    padding:14px;
    margin-bottom:20px;
    border:none;
    border-radius:8px;
    font-size:16px;
    color:#000;
}
.login-box input[type="submit"]{
    background:#f1c40f;
    color:#000;
    font-size:18px;
    font-weight:bold;
    cursor:pointer;
}
.error{
    color:#ffb3b3;
    text-align:center;
    margin-bottom:15px;
    font-size:16px;
}
</style>
</head>

<body>

<div class="overlay">

    <div class="header">
        Welcome to Student Management System
    </div>

    <div class="center-box">
        <div class="login-box">

            <h2>Login Form</h2>
             <br><br>
            <?php
            if(isset($_SESSION['loginMessage'])){
                echo "<p class='error'>".$_SESSION['loginMessage']."</p>";
                unset($_SESSION['loginMessage']);
            }
            ?>

            <form method="POST">
                <input type="text" name="username" placeholder="Enter Username" required>
                <br> <br>
                <input type="password" name="password" placeholder="Enter Password" required>
                   <br> <br>
                <input type="submit" name="login" value="LOGIN">
            </form>

        </div>
    </div>

</div>

</body>
</html>
