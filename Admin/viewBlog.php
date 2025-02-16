<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add Category</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
  include('links.php');
  ?>

  <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>


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
        <div class="card p-2">
          <h3>View Blog</h3>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Blog Title</th>
              <th scope="col">Blog Description</th>
              <th scope="col">Blog Author</th>
              <th scope="col">Blog Image</th>
              <th scope="col">Blog Category</th>
              <th scope="col">Blog Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sn = 1;
            $getBlog = mysqli_query($con, "SELECT * FROM blog_tbl");
            if (mysqli_affected_rows($con) > 0) {
              for (; $row = mysqli_fetch_assoc($getBlog); ) {
                ?>
                <tr>
                  <th><?php echo $sn++; ?></th>
                  <th><?php echo $row['title'] ?></th>
                  <th style="width: 25%;">
                    <?php echo $row['description'] ?>
                  </th>
                  <th>
                    <?php echo $row['author'] ?>
                  </th>
                  <th>
                    <img style="width:25%" src="<?php echo $row['img']; ?>">
                  </th>
                  <th>
                    <?php echo $row['category'] ?>
                  </th>
                  <th>
                    <?php
                    if ($row['status'] == 1) {
                      echo "Activate";
                    } else {
                      echo "Deactivate";
                    }
                    ?>
                  </th>
                  <th>
                    <a href="editBlog.php?key=<?php echo $row['blog_id'] ?>">
                      <i class="bi bi-pen-fill"></i>
                    </a>
                    <a href=""><i class="bi bi-trash"></i></a>
                  </th>
                </tr>
                <?php
              }
            } else {
              ?>
              <tr style="text-align:center">
                <th colspan="7">
                  <?php echo "No record found"; ?>
                </th>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>

  </div>
  <!--end::App Wrapper-->
  <?php
  include('footer.php');
  ?>


</body>
<!--end::Body-->

</html>