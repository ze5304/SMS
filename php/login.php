<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <link rel="stylesheet" href="../css/style.css">
 
  </head>
<body background="../school3.jpg" class="body_deg">

    <center>
        <div class="form_deg">
         <center class="title_deg">
  <h2>Welcome to login Form</h2>
  <h4>
    <?php
    error_reporting(0);
    session_start();
    session_destroy();
    echo $_SESSION['loginMessage'];
    ?>
  </h4>
</center>

    <form class="login_form" action="login_check.php" method="POST">

      <div class="lable_deg">
        <label>username:</label>
        <input type="text" name="username">
      </div>  <br><br>
      <div class="lable_deg">
        <label>password:</label>
        <input type="password" name="password">
      </div> <br>
      <div class="lable_deg">
        <input class="btn btn-primary" type="submit" name="submit" value="login">
      </div>
    </form>
</div>
    </center>
</body>
</html>
