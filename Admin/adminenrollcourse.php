<?php
if(!isset($_SESSION))
{
    session_start();
}

include('./adminnavbar.php');
include_once('../dbConnection.php');


if(isset($_SESSION['is_admin_login']))
{
    $adminloginemail = $_SESSION['adminloginemail'];
} else{
    echo "<script> location.href='../index.php'; </script>";
}
if(isset($_REQUEST['delete']))
{
    $sql = "DELETE FROM course_order WHERE co_id = {$_REQUEST['id']}";
    if (mysqli_query($conn, $sql)) {
        echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
    } else {
        echo "Unable to delete";
    }
}
?>

<div class="container-fluid mb-5">
    <!-- <h1 class="display-9">List of Courses</h1> -->
<?php
$sql = "SELECT * FROM course_order";
$result = $conn->query($sql);
if($result->num_rows > 0){
?>
<table class="table text-center">
    <tr class="text-light bg-dark">
      <th scope="col">Course Order Id</th>
      <th scope="col">Student Email</th>
      <th scope="col">Course ID</th>
      <th scope="col">Course Author</th>
      <th scope="col">Action</th>
    </tr>
    <?php while($row= $result->fetch_assoc()){
    echo '<tr>';
      echo '<th scope="row">'.$row['co_id'].'</th>';
      echo '<td>'.$row['email'].'</td>';
      echo '<td>'.$row['course_id'].'</td>';
      echo '<td>'.$row['course_author'].'</td>';
      echo '<td>
                <form method="POST" class="d-inline">
                <input type="hidden" name="id" value='.$row["co_id"].'>
                <button action="" type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button></td>
                </form>';
    echo '</tr>';
    }?>
</table>
<?php } ?>
</div>



<?php
include('./adminfooter.php');
?>