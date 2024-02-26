<?php
include('./adminnavbar.php');
include_once('../dbConnection.php');

if(isset($_REQUEST['studentsubmitbtn']))
{
    if(($_REQUEST['username'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['password'] == "") || ($_REQUEST['acc'] == ""))
    {
        $msg= '<div class="class="text-danger">Fill All Fields</div>';
    } else {
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $acc = $_REQUEST['acc'];
        
        $sql = "INSERT INTO student (username, email, password, acc)
        VALUES('$username','$email','$password','$acc')";
    
        if (mysqli_query($conn, $sql)) {
            $msg= '<div class="class="text-success">Added Successfully</div>';
        } else {
            $msg= '<div class="class="text-danger">error Fill All Fieldsssssss</div>';
        }
    
     }
}
?>
<!-- <div class="container mt-2 border" > -->
<form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-12">                
                    <label for="username">Student Name: </label>
                    <input class="form-control" type="text" name="username" id="username" placeholder="Course name" class="input-field">
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="email">Email: </label>
                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" class="input-field">
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="password">Password: </label>
                    <input class="form-control" type="text" name="password" id="password" placeholder="Password" class="input-field">
                    <br>
                </div>
                <div class="form-group col-sm-12">
                    <label for="acc">Occupation </label>
                    <input class="form-control" type="text" name="acc" id="acc" placeholder="Occupation" class="input-field">
                    <br>
                </div>
                <div class="text-center">
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <a href="adminstudents.php"><button class="signup-button" type="button" >Cancel</button></a>
                <button class="signup-button" type="submit" id="studentsubmitbtn" name="studentsubmitbtn">Add</button>
                </div>
                <?php if(isset($msg)) {echo $msg;} ?>
            </form>
<!-- </div> -->
<?php
include('./adminfooter.php');
?>