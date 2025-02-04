<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Register</title>

  <?php
  include('links.php');
  ?>
  <style>
    #success {
      background-color: lightgreen;
      padding: 10px;
    }

    #error {
      background-color: red;
      padding: 10px;
    }
  </style>
</head>


<body class="register-page bg-body-secondary">
  <div class="register-box">
    <!-- /.register-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header">
        <a href="login.php" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
          <h1 class="mb-0"><b>Registration</b>User</h1>
        </a>
      </div>
      <div class="card-body register-card-body">
        <!-- insert data in database -->

        <?php
        require('conn.php');

        if (isset($_COOKIE['success'])) {
          echo "<p id='success'>" . $_COOKIE['success'] . "</p>";
        }
        if (isset($_COOKIE['error'])) {
          echo "<p id='error'>" . $_COOKIE['error'] . "</p>";
        }
        //  validate user function start
        function filterData($data)
        {
          return addslashes(strip_tags(trim($data)));
        }
        //  validate user function end
        if (isset($_POST['submit'])) {
          $name = (isset($_POST['name'])) ? filterData($_POST['name']) : '';
          $email = (isset($_POST['email'])) ? filterData($_POST['email']) : '';
          $pass = (isset($_POST['pass'])) ? filterData($_POST['pass']) : '';
          $newPass = password_hash($pass, PASSWORD_BCRYPT);
          $phone = (isset($_POST['phone'])) ? filterData($_POST['phone']) : '';
          $ip = $_SERVER['REMOTE_ADDR'];
          $status = 1;

          $dataSave = mysqli_query($con, "INSERT INTO user_reg (name,email,pasword,phone,ip,status)
           VALUES('$name','$email','$newPass','$phone','$ip','$status')");

          if (mysqli_affected_rows($con) > 0) {
            setcookie("success", "Data Save Successfully", time() + 3);
            header('location:index.php');
          } else {
            setcookie("error", "Email already exits", time() + 3);
            header('location:registration.php');
          }
        }
        ?>
        <form action="" method="POST" onsubmit="return validateUser()">

          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="name" name="name" type="text" class="form-control" placeholder="" onfocus="showError(this)" />
              <label for="registerFullName">Full Name</label>
            </div>
            <div class="input-group-text"><span class="bi bi-person"></span></div>
          </div>
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="email" name="email" type="email" class="form-control" placeholder="" onfocus="showError(this)"
                onblur="hideError(this)" />
              <label for="registerEmail">Email</label>
            </div>
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
          </div>
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="pass" name="pass" type="password" class="form-control" placeholder="" onfocus="showError(this)"
                onblur="hideError(this)" />
              <label for="registerPassword">Password</label>
            </div>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="cpass" type="password" class="form-control" placeholder="" onfocus="showError(this)"
                onblur="hideError(this)" />
              <label for="registerPassword">Conform Password</label>
            </div>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="phone" name="phone" type="text" class="form-control" placeholder="" onfocus="showError(this)"
                onblur="hideError(this)" />
              <label for="registerPassword">Mobile Number</label>
            </div>
            <div class="input-group-text"><span class="bi bi-telephone-fill"></span></div>
          </div>
          <!--begin::Row-->
          <div class="row">

            <!-- /.col -->
            <div class="col-4">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="submit">Sign In</button>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->
        </form>

        <!-- /.social-auth-links -->
        <p class="mb-0">
          <a href="index.php" class="link-primary text-center"> I already have a membership </a>
        </p>
      </div>
      <!-- /.register-card-body -->
    </div>
  </div>
  <!-- /.register-box -->
  <?php
  include('footer.php');
  ?>
  <script>
    function validateUser() {
      var name = document.getElementById('name');
      if (name.value.trim() === "") {
        name.style.cssText = "border:2px solid red";
        return false;
      }
      var email = document.getElementById('email');
      if (email.value.trim() === "") {
        email.style.cssText = "border:2px solid red";
        return false;
      }

      var pass = document.getElementById('pass');
      if (pass.value.trim() === "") {
        pass.style.cssText = "border:2px solid red";
        return false;
      }

      var cpass = document.getElementById('cpass');
      if (cpass.value.trim() === "") {
        cpass.style.cssText = "border:2px solid red";
        return false;
      }

      if (pass.value != cpass.value) {
        alert('Password not match');
        pass.style.cssText = "border:2px solid red";
        return false;
      }
      var phone = document.getElementById('phone');
      if (phone.value.trim() === "") {
        phone.style.cssText = "border:2px solid red";
        return false;
      }
    }

    function showError(element) {
      if (element.value.trim() !== "") {
        element.style.cssText = "border:2px solid green";
        return false;
      }
    }

    function hideError(element) {
      if (element.value.trim() !== "") {
        element.style.cssText = "border:2px solid green";
        return false;
      } else {
        element.style.cssText = "border:2px solid red";
        return false;
      }
    }
  </script>
</body>

</html>