<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRCE Teaching Portal</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
</head>
<body>
<div class="container1">
<div class="navbar">
            <div class="logo">
                <a href="index.php">
                    <!-- <img src="./image/CRCE Logo.png" alt="" width="100px" height="90px"> -->
                    <img src="./image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                </a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php" style="color: black;">Home</a></li>
                    <li><a href="feedback.php" style="color: black;">Feedback</a></li>
                    <?php
                    session_start();
                    if(isset($_SESSION['is_login']))
                    {
                        echo '
                        <li><a href="./Student/allcourses.php">Course</a></li>
                        <li style="padding-right: 10px;"><a href="Student/studentprofile.php"><button class="button">My Profile</button></a></li>
                        <li><a href="logout.php"><button class="button" type="button">Logout</button></a></li>  ';
                    } else{
                        echo '
                        <li><a href="courses.php">Course</a></li>
                        <li style="padding-right: 10px;"><button class="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teacherlogin">Teacher Login</button></li>
                        <li><button class="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teacherregister">Teacher Registration</button></li>';

                        
                    }
                    ?>
                    

                </ul>
            </div>
      </div>
      <div class="home" id="home">
            <div class="title">
                <h1>Discover Best Courses <br> For Best Learning</h1>
                <p>"Moulding Engineers Who Can Build The Nation"</p>
                <?php
                    if(isset($_SESSION['is_login']))
                    {
                        echo ' <a href="Student/studentcourse.php"><button><button class="button">My Courses</button></a>';
                    } else{
                        echo '<button class="button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teacherregister">Get Started</button>';
                    }
                    ?>
            </div>
        </div>
        <div class="modal fade" id="registration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="registercontainer">
            <div class="box-2">
            <div class="login-form-container">
                <img src="./image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                <h1>Registration</h1>
                <form method="post" id="registerform">
                <input type="text" name="username" id="username" placeholder="Username" class="input-field">
                <br><br>
                <input type="email" name="email" id="email" placeholder="Email" class="input-field">
                <br><br>
                <input type="password" name="password" id="password" placeholder="Password" class="input-field">
                <br><br>
                <span id="message"></span>
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <br><br>
                <button class="signup-button" type="button" onclick="addstu()">Sign Up</button>
            </form>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="teacherregister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="registercontainer">
            <div class="box-2">
            <div class="login-form-container">
                <img src="./image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                <h1>Registration</h1>
                <form method="post" id="registerform">
                <input type="text" name="teacher_name" id="teacher_name" placeholder="name" class="input-field">
                <br><br>
                <input type="text" name="teacher_email" id="teacher_email" placeholder="email" class="input-field">
                <br><br>
                <input type="password" name="teacher_password" id="teacher_password" placeholder="Password" class="input-field">
                <br><br>
                <span id="message"></span>
                <!-- <input required="true" type="file" name="Profile_pic" id="Profile_pic" placeholder="Profile_pic" class="input-field"> -->
                <br><br>
                <button class="signup-button" type="button" onclick="addteacher()">Sign Up</button>
            </form>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

    <div class="modal fade" id="adminlogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                  <div class="box-2">
                  <div class="login-form-container">
                      <img src="./image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                      <h1>Admin Login</h1>
                    <form method="post" id="adminloginform">
                      <input type="text" name="adminloginemail" id="adminloginemail" placeholder="Email" class="input-field">
                      <br><br>
                      <input type="password" name="adminloginpassword" id="adminloginpassword" placeholder="Password" class="input-field">
                      <br><br>
                      <span id="adminloginmessage"></span>
                      <button class="signup-button" type="button" id="adminloginbtn" onclick="adminlogin()">Login</button>
                    </form>
                  </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="teacherlogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                  <div class="box-2">
                  <div class="login-form-container">
                      <img src="./image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                      <h1>Teacher Login</h1>
                    <form method="post" id="teacherloginform">
                      <input type="text" name="teacherloginemail" id="teacherloginemail" placeholder="Email" class="input-field">
                      <br><br>
                      <input type="password" name="teacherloginpassword" id="teacherloginpassword" placeholder="Password" class="input-field">
                      <br><br>
                      <span id="adminloginmessage"></span>
                      <button class="signup-button" type="button" id="adminloginbtn" onclick="teacherlogin()">Login</button>
                    </form>
                  </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <script>
      function teacherlogin(){
  var teacherloginemail=$('#teacherloginemail').val();
  var teacherloginpassword=$('#teacherloginpassword').val();
  console.log(teacherloginemail);

  $.ajax({
      url:'Teacher/teacher.php',
      method:'POST',
      dataType:"json",
      data:{
        checkteacherloginemail:"checkteacherloginemail",
        teacherloginemail: teacherloginemail,
        teacherloginpassword: teacherloginpassword,
      },
      success:function(data)
      {
        console.log(data);
        if(data==0)
      {
        $('#teacherloginmessage').html("<span class='text-danger'>Invalid Email Or Password</span>");
      }
      else if(data==1){
          setTimeout(() => {
              window.location.href = "Teacher/admindashboard.php";
          }, 1000);
      }
      }
    });

}

function addteacher(){
    var teacher_name=$("#teacher_name").val();
    var teacher_email=$("#teacher_email").val();
    var teacher_password=$("#teacher_password").val();

    $.ajax({
      url:'Teacher/teacher.php',
      method:'POST',
      dataType:"json",
      data:{
        signup:"signup",
        teacher_name: teacher_name,
        teacher_email: teacher_email,
        teacher_password: teacher_password,
      },
      success:function(data)
      {
        console.log("data")
        if(data=="OK")
        {
          $('#message').html("<span class='text-success'>Registration Successfull</span>");
          clearRegField();
        }
        else{
          $('#message').html("<span class='text-danger'>Invalid Email or Password</span>");
        }
      }
    });
}

    </script>
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                  <div class="box-2">
                  <div class="login-form-container">
                      <img src="./image/Fr.CRCE Name.svg" alt="" width="130px" height="90px">
                      <h1>Login</h1>
                    <form method="post" id="loginform">
                      <input type="text" name="loginemail" id="loginemail" placeholder="Email" class="input-field">
                      <br><br>
                      <input type="password" name="loginpassword" id="loginpassword" placeholder="Password" class="input-field">
                      <br><br>
                       <span id="loginmessage"></span>
                      <button class="signup-button" type="button" id="loginbtn" onclick="checklogin()">Login</button>
                    </form>
                  </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
</div>
    <small style="position:absolute; bottom:0px;"><a href="" data-bs-toggle="modal" data-bs-target="#adminlogin">Login</a></small>
    
<script type="text/javascript" src="JS\ajaxrequest.js"></script>
<script type="text/javascript" src="JS\adminajaxrequest.js"></script>
<script src="JS\jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>