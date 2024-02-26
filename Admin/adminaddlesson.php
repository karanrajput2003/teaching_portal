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

// if(isset($_REQUEST['lessonsubmitbtn']))
// {
//     if(($_REQUEST['course_name'] == "") || ($_REQUEST['course_id'] == "") || ($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['lesson_link'] == ""))
//     {
//         $msg= '<div class="class="text-danger">Fill All Fields</div>';
//     } else {
//         $lesson_name = $_REQUEST['lesson_name'];
//         $lesson_desc = $_REQUEST['lesson_desc'];
//         $course_id = $_REQUEST['course_id'];
//         $course_name = $_REQUEST['course_name'];
//         $lesson_link = $_REQUEST['lesson_link'];
//         // $lesson_link = $_FILES['lesson_link']['name'];
//         // $lesson_link_temp = $_FILES['lesson_link']['name'];
//         // $link_folder = './lessonvid/'.$lesson_link;
//         // move_uploaded_file($lesson_link_temp,$link_folder);
    
//         $sql = "INSERT INTO lesson (lesson_name, lesson_desc, lesson_link, course_id, course_name) VALUES ('$lesson_name','$lesson_desc','$lesson_link','$course_id','$course_name')";
    
//         if(mysqli_query($conn, $sql)) {
//             $msg= '<div class="class="text-success">Added Successfully</div>';
//         } else {
//             $msg= '<div class="class="text-danger">error Fill All Fieldsssssss</div>';
//         }
    
//      }
// }
if (isset($_POST['lessonsubmitbtn'])) {
    if (
        empty($_POST['course_name']) || empty($_POST['course_id']) ||
        empty($_POST['lesson_name']) || empty($_POST['lesson_desc']) ||
        empty($_POST['lesson_link'])
    ) {
        $msg = '<div class="text-danger">Fill All Fields</div>';
    } else {
        $lesson_name = $_POST['lesson_name'];
        $lesson_desc = $_POST['lesson_desc'];
        $course_id = $_POST['course_id'];
        $course_name = $_POST['course_name'];
        $lesson_link = $_POST['lesson_link'];

        $sql = "INSERT INTO lesson (lesson_name, lesson_desc, lesson_link, course_id, course_name) VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $lesson_name, $lesson_desc, $lesson_link, $course_id, $course_name);

        if (mysqli_stmt_execute($stmt)) {
            $msg = '<div class="text-success">Added Successfully</div>';
        } else {
            $msg = '<div class="text-danger">Error: ' . mysqli_error($conn) . '</div>';
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!-- <div class="container mt-2 border" > -->
<form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="course_id">Course ID: </label>
                    <input class="form-control" type="text" name="course_id" id="course_id" placeholder="Course ID:" value="<?php if(isset($_SESSION['course_id'])){ echo $_SESSION['course_id'];} ?>" readonly class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="course_name">Course Name: </label>
                    <input class="form-control" type="text" name="course_name" id="course_name" placeholder="Course name" value="<?php if(isset($_SESSION['course_name'])){ echo $_SESSION['course_name'];} ?>" readonly class="input-field">
                    <br>
                    <br>
                </div>

                <div class="form-group col-sm-12">                
                    <label for="lesson_name">Lesson Name: </label>
                    <input class="form-control" type="text" name="lesson_name" id="lesson_name" placeholder="Lesson name" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="lesson_desc">Lesson Description: </label>
                    <textarea class="form-control" row=2 type="text" name="lesson_desc" id="lesson_desc" placeholder="Lesson Decription" class="input-field"></textarea>
                    <br>
                    <br>
                </div>
                <!-- <div class="form-group col-sm-12">
                    <label for="lesson_link">Lesson Video Link: </label>
                    <input class="form-control" type="file" name="lesson_link" id="lesson_link" placeholder="Lesson Video Link:" class="input-field">
                    <br>
                    <br>
                </div> -->
                <div class="form-group col-sm-12">                
                    <label for="lesson_link">Lesson Video Link:</label>
                    <input class="form-control" type="text" name="lesson_link" id="lesson_link" placeholder="Lesson Video Link" class="input-field">
                    <br>
                    <br>
                </div>
<!-- </form> -->
                <div class="text-center">
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <a href="adminlesson.php"><button class="signup-button" type="button" >Cancel</button></a>
                <button class="signup-button" type="submit" id="lessonsubmitbtn" name="lessonsubmitbtn">Add</button>
                </div>
                <?php if(isset($msg)) {echo $msg;} ?>
            </form>
<!-- </div> -->
<?php
include('./adminfooter.php');
?>