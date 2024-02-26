<?php
if(!isset($_SESSION))
{
    session_start();
}
include_once('../dbConnection.php');

if(!isset($_SESSION['is_admin_login']))
{
    if(isset($_POST['checkadminloginemail']) && isset($_POST['adminloginemail']) && isset($_POST['adminloginpassword']))
 {
    $adminloginemail = $_POST['adminloginemail'];
    $adminloginpassword = $_POST['adminloginpassword'];
    $adminloginpassword = md5($adminloginpassword);
    

    $sql= "SELECT admin_email, admin_password FROM admin WHERE admin_email='".$adminloginemail."' AND admin_password='".$adminloginpassword."'";

    $result = mysqli_query($conn, $sql);
    $row= $result->num_rows;

    if($row===1)
    {
        $_SESSION['is_admin_login'] = true;
        $_SESSION['adminloginemail'] = $adminloginemail;
        echo json_encode($row);

    } else if($row===0)
    {
        echo json_encode($row);
    }
 }
}

?>