<?php
include('./dbconnection.php');
session_start();
if(!isset($_SESSION['loginemail']))
{
    echo "<script> location.href='index.php'; </script>";
}
$email=$_SESSION['loginemail'];
$course_id=$_SESSION['course_id'];
$course_author = $_POST['course_author'];
$sql = "INSERT INTO course_order (email, course_id, course_author) VALUES ('$email', '$course_id', '$course_author')";
if($conn->query($sql) == TRUE)
{
    echo "Redirecting to My Profile";
    echo "<script> setTimeout(() => { location.href='./Student/studentcourse.php';}, 1000); </script>";

}

?>