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
    </div>
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
<script type="text/javascript" src="/JS/ajaxrequest.js"></script>
<script type="text/javascript" src="/JS/adminajaxrequest.js"></script>
<script src="/JS/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>