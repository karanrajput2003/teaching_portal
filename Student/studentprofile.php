    <?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    include('./studentnavbar.php');

    if(isset($_SESSION['is_login']))
    {
        $email= $_SESSION['loginemail'];
    }

    if(isset($email))
    {
        $sql = "SELECT * FROM student WHERE email='$email'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $stu_id = $row['stu_id'];
        $username = $row['username'];
        $acc = $row['acc'];
        $profile_pic = $row['profile_pic'];

    }
    if(isset($_REQUEST['studentupdatebtn']))
    {
        if(($_REQUEST['username'] == ""))
        {
            $msg= '<div class="class="text-danger">Fill All Fields</div>';
        } else {
            $sname = $_REQUEST['username'];
            $sacc = $_REQUEST['acc'];
            $profile_pic = $_FILES['profile_pic']['name'];
            $profile_pic_temp = $_FILES['profile_pic']['tmp_name'];
            $img_folder= '../image/stu/'.$profile_pic;
            move_uploaded_file($profile_pic_temp, $img_folder);
        
            $sql = "UPDATE student SET username='$sname', acc='$sacc', profile_pic='$img_folder' WHERE email='$email'"; 

            if (mysqli_query($conn, $sql)) {
                $msg= '<div class="class="text-success">Updated Successfully</div>';
            } else {
                $msg= '<div class="class="text-danger">error Fill All Fieldsssssss</div>';
            }
        
        }
    }
    ?>
    <!-- <div class="container mt-2 border" > -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group col-sm-12">                
                        <label for="stu_id">Student Id: </label>
                        <input class="form-control" type="text" name="stu_id" id="stu_id" value="<?php if(isset($stu_id)){echo $stu_id; } ?>" placeholder="Student name" class="input-field" readonly>
                        <br>
                        <br>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="email">Email: </label>
                        <input class="form-control" type="text" name="email" id="email" value="<?php echo $email;?>" placeholder="Email" class="input-field" readonly>
                        <br>
                        <br>
                    </div>
                    <div class="form-group col-sm-12">                
                        <label for="username">Student Name: </label>
                        <input class="form-control" type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Student name" class="input-field">
                        <br>
                        <br>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="acc">Occupation: </label>
                        <input class="form-control" type="text" name="acc" id="acc" value="<?php if(isset($acc)){echo $acc; } ?>" placeholder="Occupation" class="input-field">
                        <br>
                        <br>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="profile_pic">Profile Image: </label>
                        <input class="form-control-file" type="file" name="profile_pic" id="profile_pic" placeholder="Course Image" class="input-field">
                        <br>
                        <br>
                    </div>
                    <div class="text-center">
                    <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                    <button class="btn btn-danger" type="submit" id="studentupdatebtn" name="studentupdatebtn">Update</button>
                    </div>
                    <?php if(isset($passmsg)) {echo $passmsg;} ?>
                </form>
    <!-- </div> -->

        

    <?php
    include('./studentfooter.php');
    ?>