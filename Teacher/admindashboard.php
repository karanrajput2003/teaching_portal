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

$sql = "SELECT * FROM course where course_author = '$teacherloginemail'";
$result = $conn->query($sql);
$total_course = $result->num_rows;

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
$total_student = $result->num_rows;

$sql = "SELECT * FROM course_order where course_author = '$teacherloginemail'";
$result = $conn->query($sql);
$total_course_order = $result->num_rows;

?>
<hr>
<div class="mt-5 text-center">
    <div class="row">
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-success mb-3" style="max-width: 20rem; height:15rem;">
                <div class="card-header">Courses</div>
                <div class="card-body">
                    <h4><?php echo $total_course; ?></h4>
                    <br>
                    <a href="./admincourses.php" style="color: white; text-decoration: none;">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-info mb-3" style="max-width: 20rem; height:15rem;">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <h4><?php echo $total_student ?></h4>
                    <br>
                    <a href="./adminstudents.php" style="color: white; text-decoration: none;">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-warning mb-3" style="max-width: 20rem; height:15rem;">
                <div class="card-header">Course Enrolled</div>
                <div class="card-body">
                    <h4><?php echo $total_course_order; ?></h4>
                    <br>
                    <a href="./adminenrollcourse.php" style="color: white; text-decoration: none;">View</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('./adminfooter.php');
?>