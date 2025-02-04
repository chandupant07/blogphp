<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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


<body class="login-page bg-body-secondary">
  <div class="login-box">

    <div class="card card-outline card-primary">
      <div class="card-header">
        <a href="index.php" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
          <h1 class="mb-0"><b>Login</b>user</h1>
        </a>
      </div>
      <div class="card-body login-card-body">
        <?php
        include('conn.php');

        if (isset($_SESSION['success'])) {
          echo "<p id='success'>" . $_SESSION['success'] . "</p>";
        }
        if (isset($_SESSION['error'])) {
          echo "<p id='error'>" . $_SESSION['error'] . "</p>";
        }
        function validateData($data)
        {
          return addslashes(strip_tags(trim($data)));
        }

        if (isset($_POST['login'])) {
          $email = (isset($_POST['email'])) ? validateData($_POST['email']) : '';
          $pass = (isset($_POST['pass'])) ? validateData($_POST['pass']) : '';

          $result = mysqli_query($con, "SELECT id,name,pasword,email FROM user_reg WHERE email='$email'");
          if (mysqli_affected_rows($con) > 0) {
            $row = mysqli_fetch_assoc($result);
            $dbPass = $row['pasword'];
            if (password_verify($pass, $dbPass)) {
              setcookie("success", "login successfully");
              header("location:dashboard.php");

              $_SESSION['loginUser'] = $row['id'];
            } else {
              setcookie("error", "invalid user name or email");
              header("location:index.php");
            }
          } else {
            echo "no record found";

          }

        }
        ?>
        <form action="" method="POST" onsubmit="return validateField()">
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="email" name="email" type="text" class="form-control" value="" placeholder=""
                onfocus="showError(this)" />
              <label for="loginEmail">Email</label>
            </div>
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
          </div>
          <div class="input-group mb-1">
            <div class="form-floating">
              <input id="pass" name="pass" type="password" class="form-control" autocomplete="on"
                onfocus="showError(this)" />
              <label for="loginPassword">Password</label>
            </div>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>
          <!--begin::Row-->
          <div class="row">
            <div class="col-8 d-inline-flex align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="login">Sign In</button>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->
        </form>
        <!-- <div class="social-auth-links text-center mb-3 d-grid gap-2">
          <p>- OR -</p>
          <a href="#" class="btn btn-primary">
            <i class="bi bi-facebook me-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-danger">
            <i class="bi bi-google me-2"></i> Sign in using Google+
          </a>
        </div> -->
        <!-- /.social-auth-links -->
        <p class="mb-1"><a href="forgot-password.html">I forgot my password</a></p>
        <p class="mb-0">
          <a href="registration.php" class="text-center"> Register a new membership </a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <?php
  include('footer.php');
  ?>
  <script>
    function validateField() {
      var email = document.getElementById('email');
      if (email.value.trim() === "") {
        email.style.cssText = "border:2px solid red";
      }
      var pass = document.getElementById('pass');
      if (pass.value.trim() === "") {
        pass.style.cssText = "border:2px solid red";
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
      if (element.value.trim() === "") {
        element.style.cssText = "border:2px solid red";
        return false;
      }
      else {
        element.style.cssText = "border:2px solid green";
        return false;
      }
    }

  </script>
</body>


</html>