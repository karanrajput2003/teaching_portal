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

if(isset($_REQUEST['studentsubmitbtn']))
{
    if(($_REQUEST['stu_id'] == "") || ($_REQUEST['username'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['password'] == "") || ($_REQUEST['acc'] == ""))
    {
        $msg= '<div class="class="text-danger">Fill All Fields</div>';
    } else {
        $sid = $_REQUEST['stu_id'];
        $sname = $_REQUEST['username'];
        $semail = $_REQUEST['email'];
        $spassword = $_REQUEST['password'];
        $sacc = $_REQUEST['acc'];
    
        $sql = "UPDATE student SET stu_id='$sid', username='$sname', email='$semail', password='$spassword', acc='$sacc' WHERE stu_id='$sid'"; 

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
        $sql= "SELECT * FROM student WHERE stu_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="stu_id">Student Id: </label>
                    <input class="form-control" type="text" name="stu_id" id="stu_id" value="<?php if(isset($row['stu_id'])) {echo $row['stu_id'];}?>" readonly placeholder="Course name" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">                
                    <label for="username">Student Name: </label>
                    <input class="form-control" type="text" name="username" id="username" value="<?php if(isset($row['username'])) {echo $row['username'];} ?>" placeholder="Course name" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="email">Email: </label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php if(isset($row['email'])) {echo $row['email'];} ?>" placeholder="Email" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="password">Password: </label>
                    <input class="form-control" type="text" name="password" id="password" value="<?php if(isset($row['password'])) {echo $row['password'];} ?>" placeholder="Password" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="acc">Occupation </label>
                    <input class="form-control" type="text" name="acc" id="acc" value="<?php if(isset($row['acc'])) {echo $row['acc'];} ?>" placeholder="Occupation" class="input-field">
                    <br>
                    <br>
                </div>
                <div class="text-center">
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <a href="adminstudents.php"><button class="signup-button" type="button" >Cancel</button></a>
                <button class="signup-button" type="submit" id="studentsubmitbtn" name="studentsubmitbtn">Update</button>
                </div>
                <?php if(isset($msg)) {echo $msg;} ?>
            </form>
</div>

<?php
include('./adminfooter.php');
?>