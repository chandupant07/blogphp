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

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
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
              <h3 class="mb-0">Update Dashboard</h3>
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
          // get id from url using ID 
          if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            echo $id;
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
                                <th>Action</th>
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
                                    <td><a
                                        href="addCategory.php?key=<?php echo $row['id'] ?>&cat_name=<?php echo $row['category_name'] ?>"><i
                                          class="bi bi-pen-fill text-info"></i></a>
                                      <a href="#"><i class="bi bi-trash3-fill text-danger"></i></a>
                                    </td>
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