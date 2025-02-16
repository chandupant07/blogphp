<?php
include('conn.php');
?>


<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Update Category</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
  include('links.php');
  ?>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <?php
    include('header.php');
    if (isset($_GET['key']) && !empty($_GET['key'])) {
      $id = $_GET['key'];
    } else {
      echo "No record found";
    }

    $dataGet = mysqli_query($con, "SELECT category_name FROM category_tbl where id=$id");
    if (mysqli_num_rows($dataGet) > 0) {
      if ($row = mysqli_fetch_assoc($dataGet)) {
        $row['category_name'];
      }
    } else {
      echo "no record found";
    }
    ?>
    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content Header-->
      <!--begin::App Content-->
      <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
          <?php

          //check input field data 
          function validateCategory($data)
          {
            return addslashes(strip_tags(trim($data)));
          }
          // update record in category
          
          if (isset($_POST['update'])) {
            $updateCategory_name = (isset($_POST['updateCategory_name'])) ? validateCategory($_POST['updateCategory_name']) : '';

            mysqli_query($con, "UPDATE category_tbl SET category_name='$updateCategory_name' WHERE id='$id';");
          }
          ?>
          <form action="" method="POST" onsubmit="return checkValidation()">
            <div class="row">
              <!-- Start col -->
              <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card mb-4">
                        <div class="card-header">
                          <h3 class="card-title">Add Blog Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="col-md-8 m-3">
                          <label for="">Category</label>
                          <input type="text" class="form-control" name="updateCategory_name" id="category_name"
                            onfocus="hideError(this)" onblur="showError(this)"
                            value="<?php echo $row['category_name'] ?>" />
                        </div>
                        <div class="col-md-4 m-3">
                          <input type="submit" class="btn btn-success" name="update" value="Update" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>

  </div>
  <!--end::App Wrapper-->
  <?php
  include('footer.php');
  ?>

  <script>
    function checkValidation() {
      var category_name = document.getElementById('category_name');
      if (category_name.value.trim() == "") {
        category_name.style.cssText = "border:2px solid red";
        return false;
      }
    }

    function hideError(element) {
      if (element.value.trim() != "") {
        element.style.cssText = "border:2px solid green";
        return false;
      }
    }

    function showError(element) {
      if (element.value.trim() != "") {
        element.style.cssText = "border:2px solid green";
        return false;
      } else {
        element.style.cssText = "border:2px solid red";
        return false;
      }
    }
  </script>
</body>
<!--end::Body-->

</html>