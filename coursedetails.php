<?php
include('./navbar.php');
include('./dbconnection.php');
// session_start();
if(!isset($_SESSION['loginemail']))
{
    echo '<script> 
    alert("Create an account or login");
    location.href="index.php"; 
    </script>';
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
        if(isset($_GET['course_id']))
        {
            $course_id=$_GET['course_id'];
            $_SESSION['course_id'] = $course_id;
            $sql= "SELECT * FROM course WHERE course_id = '$course_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }
        ?>
            <h1>Course Name: <?php echo $row['course_name'] ?></h1>
            <img src="<?php echo str_replace('..','.', $row['course_img']) ?>" alt="" srcset="" width="400px" style=" margin-left: 20px;
                                                                                                    float: left;
                                                                                                    border: 1px dotted black;
                                                                                                    margin: 0px 15px 15px 20px;">
            <p style="margin: 20px;">
                <?php echo $row['course_desc'] ?>
            </p>
            <h5>Author: <?php echo $row['course_author'] ?> </h5>
            <h6>Duration: <?php echo $row['course_duration'] ?></h6>
            <form action="studentbuy.php" method="post">
            <input type="hidden" value="<?php echo $row['course_author'] ?>">
            <button class="button" type="submit" name="buy" style="color:white;">Buy Now</button>
            </form>
            <table class="table text-center"> 
                <tr class="text-light bg-dark">
                <th scope="col">Lesson No</th>
                <th scope="col">Lesson Name</th>
                </tr>
            <?php
            $sql ="SELECT * FROM lesson ";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
            $num=0;
            while($row = $result->fetch_assoc())
            {

                if($course_id == $row['course_id']){
                    $num++;
                echo '<tr>
                <td>'.$num.'</td>
                <td>'.$row['lesson_name'].'</td>
                </tr>';
                }
            }
            }
            ?>
            </table>
        </div>
    </div>

<?php
include('./footer.php');
?>