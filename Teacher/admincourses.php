<?php
if(!isset($_SESSION))
{
    session_start();
}

include('./adminnavbar.php');
include_once('../dbConnection.php');

if(isset($_SESSION['is_teacher_login']))
{
    $teacherloginemail = $_SESSION['teacherloginemail'];
} else{
    echo "<script> location.href='../index.php'; </script>";
}

if(isset($_REQUEST['delete']))
{
    $sql = "DELETE FROM course WHERE course_id = {$_REQUEST['id']}";
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
$sql = "SELECT * FROM course WHERE course_author = '$teacherloginemail'";
$result = $conn->query($sql);
if($result->num_rows > 0){
?>
<table class="table text-center">
    <tr class="text-light bg-dark">
      <th scope="col">Course Id</th>
      <th scope="col">Name</th>
      <th scope="col">Author</th>
      <th scope="col">Action</th>
    </tr>
    <?php while($row= $result->fetch_assoc()){
    echo '<tr>';
      echo '<th scope="row">'.$row['course_id'].'</th>';
      echo '<td>'.$row['course_name'].'</td>';
      echo '<td>'.$row['course_author'].'</td>';
      echo '<td>
                <form action="admineditcourse.php" method="POST" class="d-inline">
                <input type="hidden" name="id" value='.$row["course_id"].'>
                <button class="btn btn-success" type="submit" name="view" value="view">View</button>

                </form>
                <form method="POST" class="d-inline">
                <input type="hidden" name="id" value='.$row["course_id"].'>
                <button action="" type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button></td>
                </form>';
    echo '</tr>';
    }?>
</table>
<?php } ?>
</div>

<a href="adminaddcourse.php" class="btn btn-warning box" style="position: fixed;
    bottom: 10px;
    right: 20px;
    margin-bottom: 30px;">Add</a>

<?php
include('./adminfooter.php');
?>