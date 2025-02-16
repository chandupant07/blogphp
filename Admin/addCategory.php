<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add Category</title>
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
    if (isset($_SESSION['loginUser']) && !empty($_SESSION['loginUser'])) {
      $token = $_SESSION['loginUser'];
      if (!isset($_SESSION)) {
        session_start();
      }
    }
    include('conn.php');


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
          // insert record in category
          if (isset($_POST['addcat'])) {
            $category_name = (isset($_POST['category_name'])) ? validateCategory($_POST['category_name']) : '';

            $result = mysqli_query($con, "INSERT INTO category_tbl(category_name) VALUES ('$category_name')");
            if (mysqli_affected_rows($con) > 0) {
              echo "Data saved successfully";

            } else {
              echo "Data not saved,Try again";
            }
          }

          if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $cat_name = $_REQUEST['category_name'];
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
                          <input type="text" class="form-control" name="category_name" id="category_name"
                            onfocus="hideError(this)" onblur="showError(this)" />
                        </div>
                        <div class="col-md-4 m-3">
                          <input type="submit" class="btn btn-success" name="addcat" value="submit" />
                        </div>
                      </div>
                    </div>

                    <!-- category show table -->
                    <div class="col-md-12">
                      <div class="card mb-4">
                        <div class="card-header">
                          <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Category Name</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $dataSet = mysqli_query($con, "SELECT * FROM category_tbl");

                              if (mysqli_num_rows($dataSet) > 0) {
                                $sn = 1;
                                for (; $row = mysqli_fetch_assoc($dataSet); ) {
                                  ?>
                                  <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>

                                  </tr>
                                  <?php
                                }
                              } else {
                                ?>
                                <tr>
                                  <td colspan="3" class="text-center"> "No record Found"</td>
                                </tr>
                                <?php
                              }
                              ?>


                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->

                      <!-- /.card -->
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