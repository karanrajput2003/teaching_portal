<?php


include('./navbar.php');
include_once('./dbConnection.php');


if(isset($_REQUEST['delete']))
{
    $sql = "DELETE FROM feedback_table WHERE f_id = {$_REQUEST['id']}";
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
$sql = "SELECT * FROM feedback_table";
$result = $conn->query($sql);
if($result->num_rows > 0){
?>
<table class="table text-center">
    <tr class="text-light bg-dark">
      <th scope="col">Feedback Id</th>
      <th scope="col">Feedback</th>
      <th scope="col">Student Id</th>
      <!-- <th scope="col">Action</th> -->
    </tr>
    <?php while($row= $result->fetch_assoc()){
    echo '<tr>';
      echo '<th scope="row">'.$row['f_id'].'</th>';
      echo '<td>'.$row['f_content'].'</td>';
      echo '<td>'.$row['stu_id'].'</td>';
    //   echo '<td>
    //             <form method="POST" class="d-inline">
    //             <input type="hidden" name="id" value='.$row["stu_id"].'>
    //             <button action="" type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button></td>
    //             </form>';
    echo '</tr>';
    }?>
</table>
<?php } ?>
</div>
<?php
include('./footer.php');
?>