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
    $sql = "DELETE FROM teacher WHERE t_id = {$_REQUEST['id']}";
    if (mysqli_query($conn, $sql)) {
        echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
    } else {
        echo "Unable to delete";
    }
}

?>

<div class="container-fluid mb-5">
<?php
$sql = "SELECT * FROM teacher";
$result = $conn->query($sql);
if($result->num_rows > 0){
?>
<table class="table text-center">
    <tr class="text-light bg-dark">
      <th scope="col">Teacher Id</th>
      <th scope="col">Teacher Name</th>
      <!-- <th scope="col">Email</th> -->
      <th scope="col">Action</th>
    </tr>
    <?php while($row= $result->fetch_assoc()){
    echo '<tr>';
      echo '<th scope="row">'.$row['t_id'].'</th>';
      echo '<td>'.$row['email'].'</td>';
    //   echo '<td>'.$row['email'].'</td>';
      echo '<td>
                <form action="editteacher.php" method="POST" class="d-inline">
                <input type="hidden" name="id" value='.$row["t_id"].'>
                <button class="btn btn-success" type="submit" name="view" value="view">View</button>

                </form>
                <form method="POST" class="d-inline">
                <input type="hidden" name="id" value='.$row["t_id"].'>
                <button action="" type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button></td>
                </form>';
    echo '</tr>';
    }?>
</table>
<?php } ?>
</div>

<a href="adminaddstudent.php" class="btn btn-warning box" style="position: fixed;
    bottom: 10px;
    right: 20px;
    margin-bottom: 30px;">Add New Teacher</a>

<?php
include('./adminfooter.php');
?>