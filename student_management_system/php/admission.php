<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}
elseif($_SESSION['usertype']=='student'){
   header("location:login.php");
   exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$conn = mysqli_connect($host, $user, $password, $db);
if(!$conn){
    die("Database connection failed");
}

// 1. Query from admission table
$sql = "SELECT * FROM admission";
$resulte = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <?php include 'admin_css.php'; ?>
</head>
<body>
<?php include 'admin_sidebar.php'; ?>

<div class="main-content">
    <center>
    <h1>Applied for Admission</h1> 
    <br><br>
    <table border="1">
        <tr>
            <th style="padding:20px; font-size:15px;">Name</th>
            <th style="padding:20px; font-size:15px;">Email</th>
            <th style="padding:20px; font-size:15px;">Phone</th>
            <th>Message</th>
        </tr>

        <?php
        // 2. Fetch each row
        while($info = mysqli_fetch_assoc($resulte)){
             ?>
           <tr>
                    <td style='padding:10px;'>
                        <?php echo "{$info['name']}"?>
                    </td>
                    <td style='padding:10px;'><?php echo "{$info['name']}"?>
                </td>
                    <td style='padding:10px;'><?php echo "{$info['name']}"?>
                </td>
                    <td style='padding:10px;'><?php echo "{$info['name']}"?>
                </td>
                 </tr>
          <?php       
          
       
                }
           ?>

    </table>
    </center>
</div>
</body>
</html>
