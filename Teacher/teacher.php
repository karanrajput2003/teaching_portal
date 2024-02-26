<?php
if(!isset($_SESSION))
{
    session_start();
}
include_once('../dbConnection.php');

// if(!isset($_SESSION['is_teacher_login']))
// {
    if(isset($_POST['checkteacherloginemail']) && isset($_POST['teacherloginemail']) && isset($_POST['teacherloginpassword']))
 {
    $teacherloginemail = $_POST['teacherloginemail'];
    $teacherloginpassword = $_POST['teacherloginpassword'];
    $teacherloginpassword = md5($teacherloginpassword);
    

    $sql= "SELECT email, password FROM teacher WHERE email='".$teacherloginemail."' AND password='".$teacherloginpassword."'";

    $result = mysqli_query($conn, $sql);
    $row= $result->num_rows;

    if($row===1)
    {
        $_SESSION['is_teacher_login'] = true;
        $_SESSION['teacherloginemail'] = $teacherloginemail;
        echo json_encode($row);

    } else if($row===0)
    {
        echo json_encode($row);
    }
 }
// }

if(isset($_POST['signup']) && isset($_POST['teacher_name']) && isset($_POST['teacher_email']) && isset($_POST['teacher_password']))
{
    $teacher_name = $_POST['teacher_name'];
    $teacher_email = $_POST['teacher_email'];
    $teacher_password = $_POST['teacher_password'];
    $teacher_password = md5($teacher_password);


    $sql= "INSERT INTO teacher(teacher_name, email, password) VALUES
    ('$teacher_name','$teacher_email','$teacher_password')";

if (mysqli_query($conn, $sql)) {
    echo json_encode("OK");
  } else {
    echo json_encode("Failed");
  }
}
?>