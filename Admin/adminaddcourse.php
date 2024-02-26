<?php
include('./adminnavbar.php');
include_once('../dbConnection.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['is_teacher_login'])) {
    $teacherloginemail = $_SESSION['teacherloginemail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

if (isset($_REQUEST['coursesubmitbtn'])) {
    if (
        empty($_REQUEST['course_name']) ||
        empty($_REQUEST['course_desc']) ||
        empty($_REQUEST['author']) ||
        empty($_REQUEST['course_duration']) ||
        empty($_REQUEST['course_org_price']) ||
        empty($_REQUEST['course_sell_price'])
    ) {
        $msg = '<div class="text-danger">Fill All Fields</div>';
    } else {
        $course_name = $_REQUEST['course_name'];
        $course_desc = $_REQUEST['course_desc'];
        $author = $_REQUEST['author'];
        $course_duration = $_REQUEST['course_duration'];
        $course_org_price = $_REQUEST['course_org_price'];
        $course_sell_price = $_REQUEST['course_sell_price'];
        $course_img = $_FILES['course_img']['name'];
        $course_img_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../image/courseimg/' . $course_img;
        move_uploaded_file($course_img_temp, $img_folder);

        // Use prepared statements to insert data
        $stmt = $conn->prepare("INSERT INTO course (course_name, course_desc, course_author, course_img, course_duration, course_price, course_discout) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssddd", $course_name, $course_desc, $author, $img_folder, $course_duration, $course_org_price, $course_sell_price);

        if ($stmt->execute()) {
            $msg = '<div class="text-success">Added Successfully</div>';
        } else {
            $msg = '<div class="text-danger">Error - Fill All Fields</div>';
        }
    }
}
?>
<!-- <div class="container mt-2 border" > -->
<form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="course_name">Course Name: </label>
                    <input class="form-control" type="text" name="course_name" id="course_name" placeholder="Course name" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_desc">Course Description: </label>
                    <textarea class="form-control" row=2 type="text" name="course_desc" id="course_desc" placeholder="Course Decription" class="input-field"></textarea>
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="author">Author: </label>
                    <input class="form-control" type="text" name="author" id="author" placeholder="Author" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_duration">Course Duration: </label>
                    <input class="form-control" type="text" name="course_duration" id="course_duration" placeholder="Course Duration" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_org_price">Course Orginal Price: </label>
                    <input class="form-control" type="text" name="course_org_price" id="course_org_price" placeholder="Course Orginal Price" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_img">Course Image: </label>
                    <input class="form-control-file" type="file" name="course_img" id="course_img" placeholder="Course Image" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="course_sell_price">Course Selling Price: </label>
                    <input class="form-control co" type="text" name="course_sell_price" id="course_sell_price" placeholder="Course Selling Price" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="text-center">
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <a href="admincourses.php"><button class="signup-button" type="button" >Cancel</button></a>
                <button class="signup-button" type="submit" id="coursesubmitbtn" name="coursesubmitbtn">Add</button>
                </div>
                <?php if(isset($msg)) {echo $msg;} ?>
            </form>
<!-- </div> -->
<?php
include('./adminfooter.php');
?>