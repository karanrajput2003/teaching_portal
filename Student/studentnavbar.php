<?php
include('../dbconnection.php');
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION['is_login']))
{
    $email= $_SESSION['loginemail'];
}

if(isset($email))
{
    $sql = "SELECT profile_pic FROM student WHERE email='$email'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $profile_pic = $row['profile_pic'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRCE Teaching Portal</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
</head>
<body>
<div class="container-fluid">
<div class="navbar row" style="
    margin: 0 auto;
    padding: 0 10px;
    display: flex;
    justify-content: start;
    align-items: center;
    height: 100%;">
            <div class="logo col-sm-2">
                <a href="../index.php">
                    <!-- <img src="./image/CRCE Logo.png" alt="" width="100px" height="90px"> -->
                    <img src="../image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                </a>
            </div>
            <div class="menu col-sm-8">
                <ul>
                    <li><a href="./allcourses.php">Course</a></li>
                    <li><a href="./studentfeedback.php">Feedback</a></li>
                    <li><a href="../Student/studentcourse.php">My Courses</a></li>
                    <!-- <li><a href="#">Change Password</a></li> -->
                    <li style="padding-right: 10px;"><a href="./studentprofile.php">My Profile</a></li>
                    <li><a href="../logout.php"><button class="button" type="button">Logout</button></a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <a href="./studentprofile.php" class="text-center">
                    <!-- <img src="./image/CRCE Logo.png" alt="" width="100px" height="90px"> -->
                    <img src="<?php echo $profile_pic ?>"  style="border-radius: 100%;" alt="" width="130px" height="100px">
                </a>
            </div>
      </div>
      <hr>