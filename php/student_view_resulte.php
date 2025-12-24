<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
    exit();
}

$host="localhost";
$user="root";
$password="";
$db="schoolproject";
$data = mysqli_connect($host,$user,$password,$db);

$username = $_SESSION['username'];
$sql = "SELECT * FROM results WHERE student_username='$username'";
$result = mysqli_query($data,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Results</title>
    <?php include 'student_css.php'; ?>
    <style>
     tr{
        width: 100%;

     }
     th{
        padding:10px;
        font-size:20px;
        border:solid 1px;
        background-color: skyblue;
        width: 25%;
     }


    </style>
</head>
<body>

<?php include 'sudent_sidvar.php'; ?>

<div class="main-content">
    <center>
    <h1> Veiw My Results score</h1> <br><br>

    <table>
        <tr>
            <th>Course</th>
            <th>Marks</th>
        </tr>
        <?php while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['marks']; ?></td>
        </tr>
        <?php } ?>
    </table>
     </center>
</div>

</body>
</html>
