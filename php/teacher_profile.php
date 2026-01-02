<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}
elseif($_SESSION['usertype'] != 'teacher'){
    header("location:login.php");
    exit();
}

$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$conn = mysqli_connect($host,$user,$password,$db);
if(!$conn){
    die("Database connection failed");
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>

    <?php include 'student_css.php'; ?>
</head>
<body>

<?php include 'teacher_sidebar.php'; ?>

<div class="main-content">
    <h1>Teacher Profile</h1>
    <br>

    <table border="1" style="width:50%; text-align:left;">
        <tr>
            <th style="padding:10px;">Username</th>
            <td style="padding:10px;">
                <?php echo $row['username']; ?>
            </td>
        </tr>

        <tr>
            <th style="padding:10px;">User Type</th>
            <td style="padding:10px;">
                <?php echo $row['usertype']; ?>
            </td>
        </tr>

        <tr>
            <th style="padding:10px;">Profile Image</th>
            <td style="padding:10px;">
                <?php
                if(!empty($row['profile'])){
                    echo "<img src='../{$row['profile']}' width='120'>";
                    
                }else{
                    echo "No profile image";
                }
                ?>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
