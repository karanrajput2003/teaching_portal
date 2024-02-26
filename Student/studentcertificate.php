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
?>
<html>
    <head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                display: table;
                font-family: Georgia, serif;
                font-size: 24px;
                text-align: center;
            }
            .container {
                border: 20px solid #6674CC;
                width: 750px;
                height: 563px;
                display: table-cell;
                vertical-align: middle;
            }
            .logo {
                color: #6674CC;
            }

            .marquee {
                color: #6674CC;
                font-size: 48px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }

            .inst{
                font-size: 15px;

            }
            .person {
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
            }
            .reason {
                margin: 20px;
            }
        </style>
    </head>
    <body>
       
        <div class="container">
            <div class="logo">
            <img src="../Image/courseimg/CRCE Logo.png" alt=""  height="90px">
            <img src="../image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
            </div>

            <div class="assignment" style="color: rgb(126, 126, 126);">
            Certificate of Completion
            </div>
            <div class="marquee">
                <?php
                $course_id = $_GET['course_id'];
                $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['course_name'];
                ?>
            </div>
            <div class="inst">
                Instructor : <?php
                $course_id = $_GET['course_id'];
                $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['course_author'];
                ?>
            </div>
            <div class="assignment">
                This certificate is presented to
            </div>

            <div class="person">
                <?php 
                $email = $_SESSION['loginemail'];
                $sql = "SELECT * FROM student WHERE email = '$email'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['username'];
                ?>
            </div>
            <div class="logo">
                <img src="../Image/Course-Completed.png" alt=""  height="90px">           
            </div>
        </div>
    </body>
</html>