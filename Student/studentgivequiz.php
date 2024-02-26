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
    $sql = "DELETE FROM answers WHERE lesson_id = {$_GET['lesson_id']} && email='$email'";
    if (mysqli_query($conn, $sql)) {
        // echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
        $_SESSION['quizrestart'] = false;
    } else {
        echo "Unable to delete";
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
                <p><a href="studentgivequiz.php?lesson_id='.$row['lesson_id'].'" class="lesson_'.$row['lesson_id'].'">echo '<-''.$row['lesson_name'].'</a></p>';
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
                <p><a href="studentwatchcourse.php?lesson_id='.$row['lesson_id'].'"><--</a><a href="studentgivequiz.php?lesson_id='.$row['lesson_id'].'" class="lesson_'.$row['lesson_id'].'">'.$row['lesson_name'].'</a></p>';
               }
            }
        }
        ?>
        </div>
        <div class="maincontent" style="position: absolute; top: 17%; left: 25%; margin-left: 50px; background-color: rgb(230, 230, 230); width: 1000px; height: auto; border-radius: 10px;">
        <?php
        if (isset($_GET['lesson_id'])) {
            $lesson_id = $_GET['lesson_id'];
            $sql = "SELECT * FROM lesson WHERE lesson_id = '$lesson_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<h1>Quiz Topic: ' . $row['lesson_name'] . '</h1>';
                }
            }
            $lesson_id = $_GET['lesson_id'];
            $sql = "SELECT * FROM quiz_questions WHERE lesson_id = '$lesson_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $x = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<form action="" method="POST" class="form-horizontal quiz-form" id="form_' . $row['q_id'] . '">';
                    echo '<b>Question &nbsp;' . $x++ . '&nbsp;:<br />' . $row['question_name'] . '</b><br /><br />';
                    echo '<input type="hidden" name="q_id" value="' . $row['q_id'] . '">';
                    echo '<input type="hidden" name="email" value="' . $_SESSION['loginemail'] . '">';
                    echo '<input type="hidden" name="correct_option" value="' . $row['correct_option'] . '">';
                    echo '<input type="radio" name="selected_ans_' . $row['q_id'] . '" value="' . $row['option_A'] . '">' . $row['option_A'] . '<br /><br />';
                    echo '<input type="radio" name="selected_ans_' . $row['q_id'] . '" value="' . $row['option_B'] . '">' . $row['option_B'] . '<br /><br />';
                    echo '<input type="radio" name="selected_ans_' . $row['q_id'] . '" value="' . $row['option_C'] . '">' . $row['option_C'] . '<br /><br />';
                    echo '<input type="radio" name="selected_ans_' . $row['q_id'] . '" value="' . $row['option_D'] . '">' . $row['option_D'] . '<br /><br />';
                        $lesson_id = $_GET['lesson_id'];
                        $sql = "SELECT course_id FROM lesson WHERE lesson_id = '$lesson_id'";
                        $result1 = $conn->query($sql);
                        $row1 = $result1->fetch_assoc();
                        $course_id = $row1['course_id'];
                        echo '<input type="hidden" name="course_id" value="' . $row['course_id'] . '">';
                        echo '<input type="hidden" name="lesson_id" value="' . $_GET['lesson_id'] . '">';
                        echo '<button class="signup-button quiz-submit-btn" type="button" id="submitBtn'. $row['q_id'].'" onclick="submitquiz(' . $row['q_id'] . ')">Submit</button>';
                        // echo '<button class="signup-button" type="button" id="restartBtn'. $row['q_id']. '" onclick="deletequiz(' . $row['q_id'] . ')">Restart</button>';
                        echo '</form>';
                    echo '<div id="response_' . $row['q_id'] . '"></div>';
                    
                    echo '<hr>';
                }
                echo '<form method="POST" class="d-inline m-2">
                        <button action="" type="submit" class="signup-button" style="margin:30px" name="delete" id="delete">Restart</button>
                    </form><br><br>';
            }
        } else {
            $course_id = $_GET['course_id'];
            $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<h1>' . $row['course_name'] . '</h1>';
                    echo '<p>' . $row['course_desc'] . '</p>';
                    echo '<h4> Instructor: ' . $row['course_author'] . '</h4>';
                    echo '<h5> Duration: ' . $row['course_duration'] . '</h5>';
                }
            }
            $sql = "SELECT * FROM answers WHERE email='$email' AND course_id='$course_id' AND selected_ans=correct_ans";
            $result = $conn->query($sql);
            $count = $result->num_rows;
            echo '<h6 class="alert alert-success"> Your Quiz Score:' . $count . ' </h6>';
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function submitquiz(q_id) {

            var selected_ans = $("input[name='selected_ans_" + q_id + "']:checked").val();
            var email = $("input[name='email']").val();
            var course_id = $("input[name='course_id']").val();
            var lesson_id = $("input[name='lesson_id']").val();
            var correct_option = $("input[name='correct_option']").val();

            console.log(q_id);
            console.log(correct_option);
            console.log(selected_ans);
            console.log(email);
            console.log(course_id);
            console.log(lesson_id);
            
            $.ajax({
                url: './quiz.php',
                method: 'POST',
                dataType: "json",
                data: {
                    quiz:"quiz",
                    q_id: q_id,
                    selected_ans: selected_ans,
                    correct_option: correct_option,
                    email: email,
                    course_id: course_id,
                    lesson_id: lesson_id,
                },
                success: function (data) {
                    if (data == "OK") {
                        <?php
                            $_SESSION['quizrestart'] = true; 
                        ?>
                        $('#response_' + q_id).html("<span class='text-success mx-5 mt-0'>Answer submitted successfully</span>");
                    } else {
                        $('#response_' + q_id).html("<span class='text-danger mx-5 mt-0'>Failed to submit answer</span>");
                    }
                }
            });
        }

        function deletequiz(q_id) {
            $.ajax({
                url: './addstudent.php',
                method: 'POST',
                dataType: "json",
                data: {
                    q_id: q_id,
                },
                success: function (data) {
                    if (data === "OK") {
                        <?php
                            $_SESSION['quizrestart'] = false; 
                        ?>
                        $('#response_' + q_id).html("<span class='text-success mx-5 mt-0'>Quiz restarted successfully</span>");
                    } else {
                        $('#response_' + q_id).html("<span class='text-danger mx-5 mt-0'>Failed to restart quiz</span>");
                    }
                }
            });
        }
    </script>
</div>
<?php
include('./studentfooter.php');
?>