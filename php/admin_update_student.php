<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}

if($_SESSION['usertype']=='student'){
   header("location:login.php");
   exit();
}

$conn = mysqli_connect("localhost","root","","schoolproject");
if(!$conn){
    die("DB error");
}

/* ===== GET STUDENT ===== */
if(!isset($_GET['student_id'])){
    header("location:admin_veiw_student.php");
    exit();
}

$id = $_GET['student_id'];

$sql = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$info = mysqli_fetch_assoc($result);

if(!$info){
    die("Student not found");
}

/* ===== UPDATE ===== */
if(isset($_POST['update'])){

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];

    $update = "UPDATE students SET
                username='$username',
                email='$email',
                phone='$phone',
                password='$password'
              WHERE id='$id'";

    if(mysqli_query($conn,$update)){
        header("location:admin_veiw_student.php");
        exit();
    } else {
        echo "Update failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Update Student</title>
<?php include 'admin_css.php'; ?>
<style>
label{
    width:120px;
    display:inline-block;
    text-align:right;
}
.form-box{
    background:skyblue;
    width:450px;
    padding:40px;
}
</style>
</head>

<body>
<?php include 'admin_sidebar.php'; ?>

<div class="main-content">
<center>
<h1>Update Student</h1>

<div class="form-box">
<form method="POST">

<label>Username</label>
<input type="text" name="username"
 value="<?php echo $info['username']; ?>" required><br><br>

<label>Email</label>
<input type="email" name="email"
 value="<?php echo $info['email']; ?>" required><br><br>

<label>Phone</label>
<input type="text" name="phone"
 value="<?php echo $info['phone']; ?>" required><br><br>

<label>Password</label>
<input type="text" name="password"
 value="<?php echo $info['password']; ?>" required><br><br>

<input class="btn btn-success" type="submit" name="update" value="Update">

</form>
</div>
</center>
</div>
</body>
</html>
