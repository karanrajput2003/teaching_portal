<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRCE Teaching Portal</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
</head>
<body>
<div class="container1">
<div class="navbar">
            <div class="logo">
                <a href="index.php">
                    <!-- <img src="./image/CRCE Logo.png" alt="" width="100px" height="90px"> -->
                    <img src="./image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                </a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php" style="color: black;">Home</a></li>
                    <li><a href="feedback.php" style="color: black;">Feedback</a></li>
                    <?php
                    session_start();
                    if(isset($_SESSION['is_login']))
                    {
                        echo '
                        <li><a href="./Student/allcourses.php">Course</a></li>
                        <li style="padding-right: 10px;"><a href="Student/studentprofile.php"><button class="button">My Profile</button></a></li>
                        <li><a href="logout.php"><button class="button" type="button">Logout</button></a></li>  ';
                    } else{
                        echo '
                        <li><a href="courses.php">Course</a></li>
                        <li style="padding-right: 10px;"><button class="button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registration">Register</button></li>
                        <li style="padding-right: 10px;"><button class="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">Login</button></li>
                        <li style="padding-right: 10px;"><button class="button"><a class="button" href="teacher.php" class="btn btn-primary">Faculty Login</a></button></li>';
                       
                        
                    }
                    ?>
                    

                </ul>
            </div>
      </div>