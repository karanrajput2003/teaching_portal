<?php
if(!isset($_SESSION))
{
    session_start();
}
include_once('../dbConnection.php');
if(isset($_POST['input']))
{
    $input = $_POST['input'];

    if(isset($_POST['input']))
{
    echo '<a href="adminaddlesson.php" class="btn btn-warning box" style="position: fixed;
    bottom: 10px;
    right: 20px;
    margin-bottom: 30px;">Add New Lesson</a>';
}
    $sql= "SELECT course_id FROM course";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
            $sql = "SELECT * FROM course WHERE course_id = '$input'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if ($result->num_rows <= 0){
                echo '<div class="text-alert" style="text-align:center; color:red;">Not Found</div>';
            } else
            {
                $_SESSION['course_id'] = $row['course_id'];
                $_SESSION['course_name'] = $row['course_name'];
                ?>
                <h3 class="mt-5 bg-dark text-white p-2">
                    Course ID: <?php if(isset($_POST['input'])) { echo $row['course_id']; } ?>
                    Course Name: <?php if(isset($_POST['input'])) { echo $row['course_name']; } ?>
                </h3>
                <?php
                $sql="SELECT * FROM lesson WHERE course_id = '$input'";
                $result = $conn->query($sql);
                ?>
                <table class="table text-center">
                <tr class="text-light bg-dark">
                <th scope="col">Lesson Id</th>
                <th scope="col">Lesson Name</th>
                <th scope="col">Quiz</th>
                <th scope="col">Action</th>
                </tr>
                <?php while($row= $result->fetch_assoc()){
                echo '<tr>';
                echo '<th scope="row">'.$row['lesson_id'].'</th>';
                echo '<td>'.$row['lesson_name'].'</td>';
                echo '<td>
                <form action="adminaddquiz.php" method="POST" class="d-inline m-2">
                <input type="hidden" name="id" value='.$row["lesson_id"].'>
                <button class="btn btn-info" type="submit" name="addquiz" value="addquiz">Add Quiz</button>
                </form>

                <form action="admineditquiz.php" method="POST" class="d-inline m-2">
                <input type="hidden" name="id" value='.$row["lesson_id"].'>
                <button class="btn btn-secondary" type="submit" name="viewquiz" value="viewquiz">View Quiz</button>
                </form>
                </td>';
                echo '<td>
                <form action="admineditlesson.php" method="POST" class="d-inline m-2">
                <input type="hidden" name="id" value='.$row["lesson_id"].'>
                <button class="btn btn-success" type="submit" name="view" value="view">View</button>
                </form>

                <form method="POST" class="d-inline m-2">
                <input type="hidden" name="id" value='.$row["lesson_id"].'>
                <button action="" type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button></td>
                </form>';
                echo '</tr>';}
                echo '</table>';
            } 
        }
    }


?>