<?php
include('./navbar.php');
include('./dbconnection.php');

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
                echo '<div class="card">
                <img src="'.str_replace("..",".",$row['course_img']).'" style="width:100%">
                <h2>'.$row['course_name'].'</h2>
                <p>'.$row['course_desc'].'</p>
                <a href="coursedetails.php?course_id='.$course_id.'"><button>Enroll Course</button></a>
                </div>';
            }
        }
        ?>
        

<?php
include('./footer.php');
?>