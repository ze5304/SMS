<?php
error_reporting(0);
$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$data=mysqli_connect($host,$user,$password,$db);

if($data===false){
    die("connection errer");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['username'];
     $pass=$_POST['password'];
$sql = "SELECT * FROM user 
        WHERE username='$name' 
        AND password='$pass'";
     $result=mysqli_query($data,$sql);
     $row=mysqli_fetch_array($result);
  
   if($row["usertype"]=="student"){
    session_start();
    $_SESSION['username']=$name;
    $_SESSION['usertype']="student";
    header("location:studenthome.php");
   }
    else if($row["usertype"]=="admin"){
        session_start();
     $_SESSION['username']=$name;
      $_SESSION['usertype']="admin";
    header("location:adminhome.php");
   }
   else{
    session_start();
    $message="username or password do not match ";
    $_SESSION['loginMessage']=$message;
    header("location:login.php");
   }
}
   
?>