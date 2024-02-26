<?php
if(!isset($_SESSION))
{
    session_start();
}
include('./studentnavbar.php');

if(isset($_SESSION['is_login']))
{
    $email= $_SESSION['loginemail'];
} else {
    echo "<script> location.href='index.php'; </script>";
}

if(isset($_REQUEST['delete']))
{
    $sql = "DELETE FROM answers WHERE q_id = {$_REQUEST['id']}";
    if (mysqli_query($conn, $sql)) {
        // echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
        $_SESSION['quizrestart'] = false;
    } else {
        echo "Unable to delete";
    }
}

if(isset($_POST['quizsubmitbtn']))
{
    $lesson_id = $_GET['lesson_id'];
    $sql = "SELECT * FROM quiz_questions WHERE lesson_id = '$lesson_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $qid = $row['q_id'];
    if(($_POST['selected_ans'] == ""))
    {
        // echo 'select option';
    } else{
        $sql = "SELECT * FROM quiz_questions WHERE lesson_id = '$lesson_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $course_id = $row['course_id'];
        $a = $_POST['selected_ans'];
        $qid = $_POST['q_id'];
        $correct_option = $_POST['correct_option'];
        // echo $a;
        $sql = "INSERT INTO answers(email,q_id,course_id,selected_ans,correct_ans)
        VALUES('$email','$qid','$course_id','$a','$correct_option')";
    
        if (mysqli_query($conn, $sql)) {
            $_SESSION['quizrestart'] = true;

            // echo 'done';
            // $msg= '<div class="class="text-success">Added Successfully</div>';
        } else {
            // $msg= '<div class="class="text-danger">error Fill All Fieldsssssss</div>';
        }
    }
}


?>
<div class="course_page">
        <div class="sidebar" style="position: absolute;
    top: 17%;
    margin-left: 50px;
    background-color: rgb(230, 230, 230);
    width: 300px;
    height: auto;
    border-radius: 10px;">
        <p>All Quizzes<hr> </p> 
        <?php
        if(isset($_GET['course_id']))
        {
            $course_id = $_GET['course_id'];
            $sql = "SELECT * FROM lesson WHERE course_id = '$course_id'";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()){
                echo '   
                <p><a href="studentgivequiz.php?lesson_id='.$row['lesson_id'].'" class="lesson_'.$row['lesson_id'].'">'.$row['lesson_name'].'</a></p>';
               }
            }
        } else {
            $lesson_id = $_GET['lesson_id'];
            $sql = "SELECT course_id FROM lesson WHERE lesson_id = '$lesson_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $course_id=$row['course_id'];
            $sql = "SELECT * FROM lesson WHERE course_id = '$course_id'";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()){
                echo '   
                <p><a href="studentgivequiz.php?lesson_id='.$row['lesson_id'].'" class="lesson_'.$row['lesson_id'].'">'.$row['lesson_name'].'</a></p>';
               }
            }
        }
        ?>
        </div>
        <div class="maincontent" style="position: absolute;
                                        top: 17%;
                                        left: 25%;
                                        margin-left: 50px;    
                                        background-color: rgb(230, 230, 230);
                                        width: 1000px;
                                        height: auto;
                                        border-radius: 10px;">
            <?php 
            if(isset($_GET['lesson_id']))
            {
                $lesson_id = $_GET['lesson_id'];
                $sql = "SELECT * FROM lesson WHERE lesson_id = '$lesson_id'";
                $result = $conn->query($sql);
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc()){
                    echo '<h1>Quiz Topic: '.$row['lesson_name'].'</h1>';
                }
                }
                $lesson_id = $_GET['lesson_id'];
                $sql = "SELECT * FROM quiz_questions WHERE lesson_id = '$lesson_id'";
                $result = $conn->query($sql);
                if($result->num_rows > 0)
                {
                    $x=1;
                    while($row = $result->fetch_assoc()){
                    echo '<form action="" method="POST"  class="form-horizontal" id="form">';
                    echo'<b>Question &nbsp;'.$x++.'&nbsp;:<br />'.$row['question_name'].'</b><br /><br />';
                    echo'<input type="hidden" name="q_id" id="q_id" value="'.$row['q_id'].'">';
                    echo'<input type="hidden" name="correct_option" id="correct_option" value="'.$row['correct_option'].'">';
                    echo'<input type="radio" name="selected_ans" id="selected_ans" value="'.$row['option_A'].'">'.$row['option_A'].'<br /><br />';
                    echo'<input type="radio" name="selected_ans" id="selected_ans" value="'.$row['option_B'].'">'.$row['option_B'].'<br /><br />';
                    echo'<input type="radio" name="selected_ans" id="selected_ans" value="'.$row['option_C'].'">'.$row['option_C'].'<br /><br />';
                    echo'<input type="radio" name="selected_ans" id="selected_ans" value="'.$row['option_D'].'">'.$row['option_D'].'<br /><br />';
                    if(($_SESSION['quizrestart'])==false)
                    {
                        echo '<button class="signup-button" type="submit" id="quizsubmitbtn" name="quizsubmitbtn">Submit</button></form>';
                        // echo '<button class="signup-button" type="submit" id="quizrestarttbtn" name="quizrestarttbtn">Restart</button></form>';   
                    } else{
                        // echo '<button class="signup-button" type="submit" id="quizrestartbtn" name="quizrestartbtn">Restart</button></form>';
                        echo '<form method="POST" class="d-inline m-2">
                        <input type="hidden" name="id" value='.$row["q_id"].'>
                        <button action="" type="submit" class="signup-button"" name="delete" value="delete">Restart</button></td>
                        </form>';
                    }
                    echo '<div id="response"></div>';
                    }
                }
            } else {
                $course_id = $_GET['course_id'];
                $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
                $result = $conn->query($sql);
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc()){
                    echo '<h1>'.$row['course_name'].'</h1>';
                    echo '<p>'.$row['course_desc'].'</p>';
                    echo '<h4> Instructor: '.$row['course_author'].'</h4>';
                    echo '<h5> Duration: '.$row['course_duration'].'</h5>';
                    }
                }
                $sql = "SELECT * FROM answers WHERE email='$email' AND course_id='$course_id' AND selected_ans=correct_ans";
                $result = $conn->query($sql);
                $count = $result->num_rows;
                echo '<h6 class="alert alert-success"> Your Quiz Score:'.$count.' </h6>';

            }
            
            ?>
            
            <!-- <button class="button"><a href="./week1.html" style="text-decoration: none; color:white;">Next</a> </button> -->
        </div>

    </div>
<?php
include('./studentfooter.php');
?>