<?php
include('./navbar.php');
?>
        <div class="home" id="home">
            <div class="title">
                <h1>Discover Best Courses <br> For Best Learning</h1>
                <p>"Moulding Engineers Who Can Build The Nation"</p>
                <?php
                    if(isset($_SESSION['is_login']))
                    {
                        echo '
                        <button class="button"><a href="Student/studentcourse.php">Start Learning</button></a></button>';
                    } else{
                        echo '<button class="button" type="button" data-bs-toggle="modal" data-bs-target="#registration">Get Started</button>';
                    }
                    ?>
            </div>
        </div>

<?php
include('./footer.php');
?>