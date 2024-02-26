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

if(isset($_REQUEST['lessonupdatebtn'])) {
    if(($_REQUEST['lesson_id'] == "") || ($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['lesson_link'] == "") || ($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "")) {
        $msg = '<div class="text-danger">Fill All Fields</div>';
    } else {
        $lid = $_REQUEST['lesson_id'];
        $lname = $_REQUEST['lesson_name'];
        $ldesc = $_REQUEST['lesson_desc'];
        $llink = $_REQUEST['lesson_link'];
        $cid = $_REQUEST['course_id'];
        $cname = $_REQUEST['course_name'];
    
        $sql = "UPDATE lesson SET lesson_name='$lname', lesson_desc='$ldesc', lesson_link='$llink', course_id='$cid', course_name='$cname' WHERE lesson_id='$lid'";

        if (mysqli_query($conn, $sql)) {
            $msg = '<div class="text-success">Updated Successfully</div>';
        } else {
            $msg = '<div class="text-danger">Error: ' . mysqli_error($conn) . '</div>';
        }
    }
}

?>
<div class="container mt-2 border" >
    <?php
    if(isset($_REQUEST['view']))
    {
        $sql= "SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="lesson_id">Lesson Id: </label>
                    <input class="form-control" type="text" name="lesson_id" id="lesson_id" value="<?php if(isset($row['lesson_id'])){echo $row['lesson_id']; } ?>" placeholder="Lesson name" class="input-field" readonly>
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="lesson_name">Lesson Name: </label>
                    <input class="form-control" type="text" name="lesson_name" id="lesson_name" value="<?php if(isset($row['lesson_name'])){echo $row['lesson_name']; } ?>" placeholder="Lesson name" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="lesson_desc">Lesson Description: </label>
                    <textarea class="form-control" row=3 type="text" name="lesson_desc" id="lesson_desc" placeholder="Lesson Decription" class="input-field"><?php if(isset($row['lesson_desc'])){echo $row['lesson_desc']; } ?></textarea>
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="course_id">Course Id: </label>
                    <input class="form-control" type="text" name="course_id" id="course_id" value="<?php if(isset($row['course_id'])){echo $row['course_id']; } ?>" placeholder="Course name" class="input-field" readonly>
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="course_name">Course Name: </label>
                    <input class="form-control" type="text" name="course_name" id="course_name" value="<?php if(isset($row['course_name'])){echo $row['course_name']; } ?>" placeholder="Course name" class="input-field" readonly>
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="lesson_link">Lesson Video Link: </label>
                    <input class="form-control" type="text" name="lesson_link" id="lesson_link" value="<?php if(isset($row['lesson_link'])){echo $row['lesson_link']; } ?>" placeholder="Lesson Video Link" class="input-field">
                    <br>
                    <br>
                </div>
                <!-- <div class="form-group col-sm-12">
                    <label for="lesson_link">Lesson Link: </label>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="<?php if(isset($row['lesson_link'])){echo $row['lesson_link']; } ?>" allowfullscreen></frame>
                    </div>
                    <input class="form-control" type="text" name="lesson_link" id="lesson_link" placeholder="Author" class="input-field">
                    <br>
                    <br>
                </div> -->
                <div class="text-center">
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <a href="adminlesson.php"><button class="signup-button" type="button">Cancel</button></a>
                <button class="signup-button" type="submit" id="lessonupdatebtn" name="lessonupdatebtn">Update</button>
                </div>
                <?php if(isset($msg)) {echo $msg;} ?>
            </form>
</div>

<?php
include('./adminfooter.php');
?>