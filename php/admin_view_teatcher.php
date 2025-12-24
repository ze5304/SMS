<?php
error_reporting(0);

session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='student'){
   header("location:login.php");
   
}
  $host="localhost";
   $user="root";
   $password="";
 $db="schoolproject";
$data=mysqli_connect($host,$user,$password,$db);
$sql="SELECT * from teacher";

$result=mysqli_query($data,$sql);
 if(isset($_GET['teacher_id'])){

    $t_id=$_GET['teacher_id'];
    $sql2="delete from teacher where id='$t_id'";
    $result2 = mysqli_query($data, $sql2);

    if($result2){
        header("location:admin_view_teatcher.php");
    }
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student dashboard</title>
      
      <?php
     include'admin_css.php';
       ?>
<style>
        .table_th{
         padding:20px;
         font-size:20px;   
        }
        .table_td{
          padding:20px;
          background-color:skyblue;  
        }
    
</style>
</head>
<body>
<?php
 include'admin_sidebar.php';

?> 

   <div class="main-content">
    <center> <h1>View All Teatcher Data</h1> 
  <table border="1px">
    <tr>
        <th class="table_th">teatcher name</th>
        <th class="table_th">about teatcher</th>
        <th class="table_th">image</th>
        <th class="table_th">delete</th>
         <th class="table_th">Update</th>

    </tr>
<?php
     while($info=$result->fetch_assoc()){

   
       
?>

    <tr>
        <td class="table_td" >
            <?php echo"{$info['name']}"?>
        </td>
        <td class="table_td"><?php echo"{$info['description']}"?></td>
       <td class="table_td">
    <img src="<?php echo $info['image']; ?>" alt="Teacher Image" width="100">
    
    <td class="table_td">
    <?php
        echo "<a onclick=\"javascript:return confirm('Are you sure delete this');\" class='btn btn-danger' href='admin_view_teatcher.php?teacher_id={$info['id']}'>Delete</a>";
    ?>
</td>

    <td class="table_td">
      <?php
        echo "<a onclick=\"javascript:return confirm('Are you sure update this');\" class='btn btn-primary' href='admin_update_teatcher.php?teacher_id={$info['id']}'>Update</a>";
    ?>

    </td>


  

    </tr>
    <?php
     }?>
  </table>

    </center>
     
   
      
   </div>
</body>
</html>