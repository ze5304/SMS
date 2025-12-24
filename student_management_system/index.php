<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);


$sql_teacher = "SELECT * FROM teacher";
$sql_course  = "SELECT * FROM courses";

$result_teacher = mysqli_query($data, $sql_teacher);
$result_course  = mysqli_query($data, $sql_course);

if (isset($_SESSION['message'])) {
    echo "<script>
        alert('{$_SESSION['message']}');
    </script>";

    unset($_SESSION['message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="./css/style.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
   <nav>
    <label class="logo">WOLDIA-UNIVERISITY</label>
    <UL>
       
         
         <li><a href="./php/admission.php">admission</a></li>
         <li><a href="./php/login.php" class="btn btn-success">login</a></li>
          
    </UL>
   </nav>
  <div class="section1">
     <label class="img_text">We Teach Student with care</label>
    <img src="school_management.jpg" class="main_imag" alt="">
</div>
 <div class="container">
    <div class="row">
     
     

        <div class="col-md-4">
      <img class="welcome_img" src="school2.jpg" alt="">
        </div>
        <div class="col-md-8">
  <h1>welcome to woldia university</h1>
  <p>
Woldia University is committed to providing quality education, fostering innovation, 
and shaping responsible citizens. Our Student Management System is designed to support 
students and staff by simplifying academic administration, improving communication, 
and ensuring efficient access to academic information. We strive to create a supportive 
learning environment where students can grow academically and personally.
</p>

        </div>
    </div>
 </div>
    
  <center>
    <h1>our teacher</h1>
  </center>
  <div class="container">
    <div class="row">

       <?php 
      while($info= $result_teacher->fetch_assoc()){

      ?>
        <div class="col-md-4">
        <img class="teacher"src="<?php echo $info['image']; ?>" alt="">
        
       <h3><?php echo"{$info['name']}"  ?></h3>
       <h5><?php echo"{$info['description']}"  ?></h5>
      
        </div>
      <?php
            }
           ?>

         
    </div>
  </div>


       <center>
    <h1>your course</h1>
    </center>
    <div class="container">
    <div class="row">
       <?php 
      while($info=$result_course->fetch_assoc()){

      ?>
        <div class="col-md-4">
        <img class="course"src="<?php echo $info['image'] ?>" alt="">
        
       <h3><?php echo"{$info['name']}"  ?></h3>
       <h5><?php echo"{$info['description']}"  ?></h5>
      
        </div>
      <?php
            }
           ?>

        </div>
    </div>
  </div>

    <center>
      <h1 class="adm">Admission form </h1>
    </center>
          <div align="center" class="Admission_form">
   <form action="php/data_check.php" method="post" id="admissionForm">

        <div class="adm_int">
          <label class="label_text">Name:</label>
          <input class="input_deg" type="text" name="name">
        </div>

           <div class="adm_int">
          <label class="label_text">Email:</label>
          <input class="input_deg"  type="text" name="email">
        </div>
           <div class="adm_int">
          <label class="label_text">phone:</label>
          <input class="input_deg" type="text" name="phone">
        </div>
           <div  class="adm_int">
          <label class="label_text" >message:</label>
          <textarea class ="input_txt" name="message">

          </textarea>
        </div class="adm_int">
        <div>
          <input class="btn btn-primary"  id="submit" type="submit" value="apply" name="apply">
        </div>
      </form>
      </div>

        <script>
document.getElementById("admissionForm").addEventListener("submit", function(e){

    let name = document.querySelector("input[name='name']").value.trim();
    let email = document.querySelector("input[name='email']").value.trim();
    let phone = document.querySelector("input[name='phone']").value.trim();
    let message = document.querySelector("textarea[name='message']").value.trim();

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let phonePattern = /^[0-9]{9,}$/;

    
    if(name === ""){
        alert("Please enter your name");
        e.preventDefault();
        return;
    }

 
    if(email === ""){
        alert("Please enter your email");
        e.preventDefault();
        return;
    }

    if(!emailPattern.test(email)){
        alert("Please enter a valid email address");
        e.preventDefault();
        return;
    }


    if(phone === ""){
        alert("Please enter your phone number");
        e.preventDefault();
        return;
    }

    if(!phonePattern.test(phone)){
        alert("Please enter a valid phone number");
        e.preventDefault();
        return;
    }

    if(message === ""){
        alert("Please enter your message");
        e.preventDefault();
        return;
    }

});
</script>

       


     
         <?php
     include'./php/admin_footer.php';
       ?>


      
</body>
</html>