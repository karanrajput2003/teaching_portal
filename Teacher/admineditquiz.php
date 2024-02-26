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
    
        $sql = "INSERT INTO quiz_questions(lesson_id, question_name, option_A, option_B, option_C, option_D, correct_option)
        VALUES('$lesson_id','$question_name','$option_A','$option_B','$option_C','$option_D','$correct_option')";
    
        if (mysqli_query($conn, $sql)) {
            $msg= '<div class="class="text-success">Added Successfully</div>';
        } else {
            $msg= '<div class="class="text-danger">error Fill All Fieldsssssss</div>';
        }
    
     }
}

    if(isset($_REQUEST['viewquiz']))
    {
        $sql= "SELECT * FROM quiz_questions WHERE lesson_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);

    // <?php
        $i=1;
        while($row= $result->fetch_assoc())
    {
    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="question_name">Question <?php echo $i++; ?> </label>
                    <input class="form-control" type="text" name="question_name" id="question_name" value="<?php if(isset($row['question_name'])){echo $row['question_name']; } ?>" placeholder="Enter Question Here" class="input-field">
                    <br>
                </div>
                <div class="row">
                <div class="form-group col-sm-6">                
                    <label for="option_A">Option A:</label>
                    <input class="form-control" type="text" name="option_A" id="option_A" value="<?php if(isset($row['option_A'])){echo $row['option_A']; } ?>" placeholder="Option A" class="input-field">
                    <br>
                </div>
                <div class="form-group col-sm-6">                
                    <label for="option_B">Option B:</label>
                    <input class="form-control" type="text" name="option_B" id="option_B" value="<?php if(isset($row['option_B'])){echo $row['option_B']; } ?>" placeholder="Option B" class="input-field">
                    <br>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-sm-6">                
                    <label for="option_C">Option C:</label>
                    <input class="form-control" type="text" name="option_C" id="option_C" value="<?php if(isset($row['option_C'])){echo $row['option_C']; } ?>" placeholder="Option C" class="input-field">
                    <br>
                </div>
                <div class="form-group col-sm-6">                
                    <label for="option_D">Option D:</label>
                    <input class="form-control" type="text" name="option_D" id="option_D" value="<?php if(isset($row['option_D'])){echo $row['option_D']; } ?>" placeholder="Option D" class="input-field">
                    <br>
                </div>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="correct_option">Correct Answer</label>
                    <input class="form-control" type="text" name="correct_option" id="correct_option" value="<?php if(isset($row['correct_option'])){echo $row['correct_option']; } ?>" placeholder="Correct Answer" class="input-field">
                    <br>
                </div>
            </form>
<?php
    }
            
    echo '<div class="text-center"><a href="adminlesson.php"><button class="signup-button" type="button">Cancel</button></a></div><br>';
}
include('./adminfooter.php');
?>