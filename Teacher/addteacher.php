<?php
if(!isset($_SESSION))
{
    session_start();
}
include_once('../dbConnection.php');
//insert
if(isset($_POST['signup']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);


    $sql= "INSERT INTO student(username, email, password) VALUES
    ('$username','$email','$password')";

if (mysqli_query($conn, $sql)) {
    echo json_encode("OK");
  } else {
    echo json_encode("Failed");
  }
}


// if (isset($_POST['q_id']) && !isset($_POST['course_id'])) {
//     $q_id = $_POST['q_id'];
//     $selected_ans = $_POST['selected_ans'];
//     $course_id = $_POST['course_id'];
//     $email = $_POST['email'];
//     $correct_option = $_POST['correct_option'];

//     $stmt = $conn->prepare("INSERT INTO answers(email, q_id, course_id, selected_ans, correct_ans) VALUES (?, ?, ?, ?, ?)");
//     $stmt->bind_param("siiss", $email, $q_id, $course_id, $selected_ans, $correct_option);

//     if ($stmt->execute()) {
//         $_SESSION['quizrestart'] = true;
//         echo json_encode("OK");
//     } else {
//         echo json_encode("Failed");
//     }
// }

if (isset($_POST['q_id'])) {
    $q_id = $_POST['q_id'];

    $stmt = $conn->prepare("DELETE FROM answers WHERE q_id = ?");
    $stmt->bind_param("i", $q_id);

    if ($stmt->execute()) {
        $_SESSION['quizrestart'] = false;
        echo json_encode("OK");
    } else {
        echo json_encode("Failed");
    }
}


//login verification

if(!isset($_SESSION['is_login']))
{
    if(isset($_POST['checkloginemail']) && isset($_POST['loginemail']) && isset($_POST['loginpassword']))
 {
    $loginemail = $_POST['loginemail'];
    $loginpassword = $_POST['loginpassword'];
    $loginpassword = md5($loginpassword);

    $sql= "SELECT email, password FROM student WHERE email='".$loginemail."' AND password='".$loginpassword."'";

    $result = mysqli_query($conn, $sql);
    $row= $result->num_rows;

    if($row===1)
    {
        $_SESSION['is_login'] = true;
        $_SESSION['loginemail'] = $loginemail;
        echo json_encode($row);
        // echo "<script> location.href='studentprofile.php'; </script>"


    } else if($row===0)
    {
        echo json_encode($row);
    }
 }
}

?>