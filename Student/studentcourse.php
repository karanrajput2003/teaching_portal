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
?>

<div class="course_page">
        
        <div class="maincontent" style="position: absolute;
                                        top: 17%;
                                        left:5%;
                                        margin-left: 50px;
                                        background-color: rgb(230, 230, 230);
                                        width: 1250px;
                                        height: auto;
                                        border-radius: 10px;">
            <?php
            if(isset($email))
            {
                $sql = "SELECT co.course_price, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author FROM course_order as co JOIN course as c ON c.course_id=co.course_id WHERE co.email='$email'";
                $result=$conn->query($sql);
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc()){ ?>
                        <h1><?php echo $row['course_name'] ?></h1>
                        <img src="<?php echo $row['course_img'] ?>" alt="" srcset="" width="400px" height="200px" style=" margin-left: 20px;
                                                                                                    float: left;
                                                                                                    border: 1px dotted black;
                                                                                                    margin: 0px 15px 15px 20px;">
                    <p style="margin: 20px;">
                <?php echo $row['course_desc'] ?>
            </p>
            <h5>Instructor: <?php echo $row['course_author'] ?> </h5>
            <h6>Duration: <?php echo $row['course_duration'] ?></h6>
            <button class="button"><a href="studentwatchcourse.php?course_id=<?php echo $row['course_id'] ?>" type="submit" name="Watch" style="color:white; text-decoration:none;">Watch</a></button>
             <hr>
             <?php       }
                }

            }
            ?>
        </div>
    </div>

<?php
include('./studentfooter.php');
?>