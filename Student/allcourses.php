<?php
include('./studentnavbar.php');
include('../dbconnection.php');

?>
    <h1 id="heading">Courses</h1>
    <div class="course" id="course">
        <?php
        $sql = "SELECT * FROM course";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc())
            {
                $course_id = $row['course_id'];
                echo '<div class="card" style="width: 18rem;">
                <img class="card-img-top" src="'.$row['course_img'].'" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">'.$row['course_name'].'</h5>
                  <p class="">'.$row['course_desc'].'</p>
                 <a href="../coursedetails.php?course_id='.$course_id.'""><button>Enroll Course</button></a>
                </div>
              </div>';
            }
        }
        ?>
        

<?php
include('./studentfooter.php');
?>