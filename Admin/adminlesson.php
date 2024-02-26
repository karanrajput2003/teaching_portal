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

if(isset($_REQUEST['delete']))
{
    $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
    if (mysqli_query($conn, $sql)) {
        echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
    } else {
        echo "Unable to delete";
    }
}
?>

<div class="col-sm-12 ">
        <div class="form-group m-5">
            <label for="live_search">Enter Course ID:</label>
            <input type="text" class="input-field" id="live_search" name="live_search">
        </div>
        <br>
        <div  id="searchresult">

        </div>
        
</div>

<script>
    $(document).ready(function(){
        $("#live_search").keyup(function(){
            var input = $(this).val();
            // alert(input);
            if(input != "")
            {
                $.ajax({
                    url:"update.php",
                    method:"POST",
                    data:{input:input},

                    success:function(data)
                    {
                        $("#searchresult").html(data);
                    }
                });
            } else {
            }
        });
    });
</script>


<?php

?>




<?php
include('./adminfooter.php');
?>