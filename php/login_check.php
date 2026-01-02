<?php
error_reporting(0);
session_start();

$conn = mysqli_connect("localhost","root","","schoolproject");
if(!$conn){
    die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_POST['username'];
    $pass = $_POST['password'];

    // check user table
    $sql = "SELECT * FROM user 
            WHERE username='$name' 
            AND password='$pass'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);

        /* ===== STUDENT ===== */
        if($row['usertype']=="student"){

            // 🔴 GET student_id from students table
            $s_q = mysqli_query($conn,
                "SELECT id FROM students WHERE username='$name'"
            );
            $student = mysqli_fetch_assoc($s_q);

            $_SESSION['username']   = $name;
            $_SESSION['usertype']   = "student";
            $_SESSION['student_id'] = $student['id']; // ⭐⭐⭐ VERY IMPORTANT

            header("location:studenthome.php");
            exit();
        }

        /* ===== ADMIN ===== */
        else if($row['usertype']=="admin"){
            $_SESSION['username']=$name;
            $_SESSION['usertype']="admin";
            header("location:adminhome.php");
            exit();
        }

        /* ===== TEACHER ===== */
        else if($row['usertype']=="teacher"){
            $_SESSION['username']=$name;
            $_SESSION['usertype']="teacher";
            header("location:teacherhome.php");
            exit();
        }
    }

    $_SESSION['loginMessage']="Username or password do not match";
    header("location:login.php");
}
?>
