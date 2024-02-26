<?php
if(!isset($_SESSION))
{
    session_start();
}
include('./studentnavbar.php');

if(isset($_SESSION['is_login']))
{
    $email= $_SESSION['loginemail'];
} else{
    echo "<script> location.href='index.php'; </script>";
}

$sql = "SELECT * FROM student WHERE email='$email'";
    $result=$conn->query($sql);
    if($result->num_rows ==1)
    {
        $row=$result->fetch_assoc();
        $stu_id = $row['stu_id'];
    }
if(isset($_REQUEST['studentfeedbackbtn']))
{
    if(($_REQUEST['f_content'] == ""))
    {
        $msg= '<div class="class="text-danger">Fill All Fields</div>';
    } else {
        $fcontent = $_REQUEST['f_content'];
        $sql = "INSERT INTO feedback_table (f_content, stu_id) VALUES ('$fcontent', '$stu_id')";
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
                    <label for="f_content">Write Feedback</label>
                    <textarea name="f_content" id="f_content" rows="5" cols="190"  type="text"></textarea>
                    <br>
                    <br>
                </div>
                <div class="text-center">
                <button class="btn btn-danger" type="submit" id="studentfeedbackbtn" name="studentfeedbackbtn">Update</button>
                </div>
                <?php if(isset($passmsg)) {echo $passmsg;} ?>
            </form>
<!-- </div> -->

      

<?php
include('./studentfooter.php');
?>