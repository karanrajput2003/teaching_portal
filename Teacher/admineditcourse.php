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

if(isset($_REQUEST['courseupdatebtn']))
{
    if(($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['author'] == "")
     || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_org_price'] == "") 
     || ($_REQUEST['course_sell_price'] == ""))
    {
        $msg= '<div class="class="text-danger">Fill All Fields</div>';
    } else {
        $cid = $_REQUEST['course_id'];
        $cname = $_REQUEST['course_name'];
        $cdesc = $_REQUEST['course_desc'];
        $cauthor = $_REQUEST['author'];
        $cduration = $_REQUEST['course_duration'];
        $corgprice = $_REQUEST['course_org_price'];
        $cprice = $_REQUEST['course_sell_price'];
        $cimg = '../image/courseimg/'.$_FILES['course_img']['name'];
    
        $sql = "UPDATE course SET course_id='$cid', course_name='$cname', course_desc='$cdesc', course_author='$cauthor', 
        course_img='$cimg', course_duration='$cduration', course_price='$corgprice', course_discout='$cprice' WHERE course_id='$cid'";

        if (mysqli_query($conn, $sql)) {
            $msg= '<div class="class="text-success">Updated Successfully</div>';
        } else {
            $msg= '<div class="class="text-danger">error Fill All Fieldsssssss</div>';
        }
    
     }
}
?>
<div class="container mt-2 border" >
    <?php
    if(isset($_REQUEST['view']))
    {
        $sql= "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="course_id">Course Id: </label>
                    <input class="form-control" type="text" name="course_id" id="course_id" value="<?php if(isset($row['course_id'])){echo $row['course_id']; } ?>" placeholder="Course name" class="input-field" readonly>
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="course_name">Course Name: </label>
                    <input class="form-control" type="text" name="course_name" id="course_name" value="<?php if(isset($row['course_name'])){echo $row['course_name']; } ?>" placeholder="Course name" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_desc">Course Description: </label>
                    <textarea class="form-control" row=3 type="text" name="course_desc" id="course_desc" placeholder="Course Decription" class="input-field"><?php if(isset($row['course_desc'])){echo $row['course_desc']; } ?></textarea>
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="author">Author: </label>
                    <input class="form-control" type="text" name="author" id="author" value="<?php if(isset($row['course_author'])){echo $row['course_author']; } ?>" placeholder="Author" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_duration">Course Duration: </label>
                    <input class="form-control" type="text" name="course_duration" id="course_duration" value="<?php if(isset($row['course_duration'])){echo $row['course_duration']; } ?>" placeholder="Course Duration" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_org_price">Course Orginal Price: </label>
                    <input class="form-control" type="text" name="course_org_price" id="course_org_price" value="<?php if(isset($row['course_price'])){echo $row['course_price']; } ?>" placeholder="Course Orginal Price" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_img">Course Image: </label>
                    <img src="<?php if(isset($row['course_img'])){echo $row['course_img']; } ?>" class="img-thumbnail">
                    <input class="form-control-file" type="file" name="course_img" id="course_img" placeholder="Course Image" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_sell_price">Course Selling Price: </label>
                    <input class="form-control co" type="text" name="course_sell_price" id="course_sell_price" value="<?php if(isset($row['course_discout'])){echo $row['course_discout']; } ?>" placeholder="Course Selling Price" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="text-center">
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <a href="admincourses.php"><button class="signup-button" type="button" >Cancel</button></a>
                <button class="signup-button" type="submit" id="courseupdatebtn" name="courseupdatebtn">Update</button>
                </div>
                <?php if(isset($msg)) {echo $msg;} ?>
            </form>
</div>

<?php
include('./adminfooter.php');
?>