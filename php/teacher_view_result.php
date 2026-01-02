<?php
session_start();
if($_SESSION['usertype'] != 'teacher'){
    header("location:login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","schoolproject");
if(!$conn){
    die("DB Error");
}

/* ===== DELETE ===== */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM result WHERE id='$id'");
    header("location:teacher_view_result.php");
    exit();
}

/* ===== SAVE UPDATE ===== */
if(isset($_POST['save_update'])){
    $id   = $_POST['result_id'];
    $mark = $_POST['mark'];

    mysqli_query($conn, "UPDATE result SET mark='$mark' WHERE id='$id'");
    header("location:teacher_view_result.php");
    exit();
}

/* ===== FETCH RESULTS ===== */
$sql = "SELECT 
            result.id AS result_id,
            students.username AS student_name,
            courses.name AS course_name,
            result.mark
        FROM result
        JOIN students ON result.student_id = students.id
        JOIN courses ON result.course_id = courses.id";

$result = mysqli_query($conn,$sql);

/* ===== EDIT MODE ===== */
$edit_id = isset($_GET['edit']) ? $_GET['edit'] : null;
?>

<!DOCTYPE html>
<html>
<head>
<title>View Results</title>
<?php include 'student_css.php'; ?>
</head>
<body>

<?php include 'teacher_sidebar.php'; ?>

<div class="main-content">
<h1>Student Results</h1>

<table border="1" width="90%">
<tr>
    <th>Student</th>
    <th>Course</th>
    <th>Mark</th>
    <th>Action</th>
    <th>Delete</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?= $row['student_name']; ?></td>
    <td><?= $row['course_name']; ?></td>

    <!-- MARK -->
    <td style="text-align:center;">
        <?php if($edit_id == $row['result_id']){ ?>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="result_id" value="<?= $row['result_id']; ?>">
                <input type="number" name="mark" value="<?= $row['mark']; ?>" style="width:80px;">
        <?php }else{ ?>
            <?= $row['mark']; ?>
        <?php } ?>
    </td>

    <!-- UPDATE / SAVE -->
    <td style="text-align:center;">
        <?php if($edit_id == $row['result_id']){ ?>
                <button type="submit" name="save_update" class="btn btn-success btn-sm">
                    Save
                </button>
            </form>
        <?php }else{ ?>
            <a href="teacher_view_result.php?edit=<?= $row['result_id']; ?>"
               class="btn btn-primary btn-sm">
               Update
            </a>
        <?php } ?>
    </td>

    <!-- DELETE -->
    <td style="text-align:center;">
        <a onclick="return confirm('Delete this result?')"
           href="teacher_view_result.php?delete=<?= $row['result_id']; ?>"
           class="btn btn-danger btn-sm">
           Delete
        </a>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
