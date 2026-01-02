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

$sql = "SELECT * FROM courses";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher - View Courses</title>

    <?php include 'student_css.php'; ?>
</head>
<body>

<?php include 'teacher_sidebar.php'; ?>

<div class="main-content">
    <h1>My Courses</h1>
    <br>

    <table border="1" style="width:90%; margin:auto; text-align:left;">
        <tr>
            <th style="padding:10px;">Course Name</th>
            <th style="padding:10px;">Description</th>
            <th style="padding:10px;">Image</th>
        </tr>

        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td style="padding:10px;">
                <?php echo $row['name']; ?>
            </td>

            <td style="padding:10px;">
                <?php echo $row['description']; ?>
            </td>

            <td style="padding:10px;">
                <?php
                if(!empty($row['image'])){
                    echo "<img src='../{$row['image']}' width='100'>";
                }else{
                    echo "No image";
                }
                ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
