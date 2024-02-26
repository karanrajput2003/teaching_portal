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

if(isset($_REQUEST['addquizbtn']))
{
    if(($_REQUEST['lesson_id'] == "") || ($_REQUEST['question_name'] == "") || ($_REQUEST['option_A'] == "") || ($_REQUEST['option_B'] == "")
     || ($_REQUEST['option_C'] == "") || ($_REQUEST['option_D'] == "") 
     || ($_REQUEST['correct_option'] == ""))
    {
        $msg= '<div class="class="text-danger">Fill All Fields</div>';
    } else {
        $lesson_id= $_REQUEST['lesson_id'];
        $question_name = $_REQUEST['question_name'];
        $option_A = $_REQUEST['option_A'];
        $option_B = $_REQUEST['option_B'];
        $option_C = $_REQUEST['option_C'];
        $option_D = $_REQUEST['option_D'];
        $correct_option = $_REQUEST['correct_option'];
        $sql = "SELECT course_id FROM lesson WHERE lesson_id = '$lesson_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $course_id=$row['course_id'];
    
        $sql = "INSERT INTO quiz_questions(lesson_id,course_id, question_name, option_A, option_B, option_C, option_D, correct_option)
        VALUES('$lesson_id','$course_id','$question_name','$option_A','$option_B','$option_C','$option_D','$correct_option')";
    
        if (mysqli_query($conn, $sql)) {
            $msg= '<div class="class="text-success">Added Successfully</div>';
        } else {
            $msg= '<div class="class="text-danger">error Fill All Fieldsssssss</div>';
        }
    
     }
}

    if(isset($_REQUEST['addquiz']))
    {
        $sql= "SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="lesson_id">Lesson Id: </label>
                    <input class="form-control" type="text" name="lesson_id" id="lesson_id" value="<?php if(isset($row['lesson_id'])){echo $row['lesson_id']; } ?>" placeholder="Lesson id" class="input-field" readonly>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="question_name">Question</label>
                    <input class="form-control" type="text" name="question_name" id="question_name" placeholder="Enter Question Here" class="input-field">
                    <br>
                </div>
                <div class="row">
                <div class="form-group col-sm-6">                
                    <label for="option_A">Option A:</label>
                    <input class="form-control" type="text" name="option_A" id="option_A" placeholder="Option A" class="input-field">
                    <br>
                </div>
                <div class="form-group col-sm-6">                
                    <label for="option_B">Option B:</label>
                    <input class="form-control" type="text" name="option_B" id="option_B" placeholder="Option B" class="input-field">
                    <br>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-sm-6">                
                    <label for="option_C">Option C:</label>
                    <input class="form-control" type="text" name="option_C" id="option_C" placeholder="Option C" class="input-field">
                    <br>
                </div>
                <div class="form-group col-sm-6">                
                    <label for="option_D">Option D:</label>
                    <input class="form-control" type="text" name="option_D" id="option_D" placeholder="Option D" class="input-field">
                    <br>
                </div>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="correct_option">Correct Answer</label>
                    <input class="form-control" type="text" name="correct_option" id="correct_option" placeholder="Option D" class="input-field">
                    <br>
                </div>
                <div class="text-center">
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <a href="adminlesson.php"><button class="signup-button" type="button">Cancel</button></a>
                <button class="signup-button" type="submit" id="addquizbtn" name="addquizbtn">Add</button>
                </div>
                <?php if(isset($msg)) {echo $msg;} ?>
            </form>

<?php
include('./adminfooter.php');
?>