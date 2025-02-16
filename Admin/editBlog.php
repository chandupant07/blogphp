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
        <div class="container-fluid">
          <?php



          //check input field data 
          function validateBlog($data)
          {
            return addslashes(strip_tags(trim($data)));
          }
          // insert record in category
          if (isset($_POST['addBlog'])) {
            $blogTitle = (isset($_POST['blogTitle'])) ? validateBlog($_POST['blogTitle']) : '';
            $categoryBlog = (isset($_POST['categoryBlog'])) ? validateBlog($_POST['categoryBlog']) : '';
            $blgAuth = (isset($_POST['blgAuth'])) ? validateBlog($_POST['blgAuth']) : '';
            $blgDes = (isset($_POST['blgDes'])) ? validateBlog($_POST['blgDes']) : '';
            $blgImg = $_FILES['fileToUpload'];
            $status = 1;
            $fileName = $_FILES['fileToUpload']['name'];
            $tempName = $_FILES['fileToUpload']['tmp_name'];
            $destination = 'upload/' . $fileName;
            move_uploaded_file($tempName, $destination);

          }
          ?>

          <?php
          if (isset($_REQUEST['key'])) {
            $token = $_REQUEST['key'];
          } else {
            echo "no record found";
          }

          $getData = mysqli_query($con, "SELECT title,description,img,category,author FROM blog_tbl where blog_id='$token'");
          if (mysqli_num_rows($getData) > 0) {
            $row = mysqli_fetch_assoc($getData);
          } else {
            echo "invalid data....";
          }
          ?>
          <form action="" method="POST" onsubmit="return checkValidation()" enctype="multipart/form-data">
            <div class="row">
              <!-- Start col -->
              <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card-header">
                        <h3 class="card-title">Edit Blog</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="col-12" class="form-group">
                        <div class="col-md-6 m-3">
                          <label for="">Blog Title</label>
                          <input type="text" class="form-control" name="blogTitle" id="blogTitle"
                            onfocus="hideError(this)" onblur="showError(this)" value="<?php echo $row['title'] ?>" />
                        </div>

                        <div class="col-6 m-3">
                          <label>Select Category</label>
                          <select class="form-control" name="categoryBlog">

                            <?php
                            $getCategory = mysqli_query($con, "SELECT category FROM blog_tbl where blog_id='$token'");
                            if (mysqli_num_rows($getCategory)) {
                              ?>
                              <option>--select--</option>
                              <?php
                              for (; $cat = mysqli_fetch_assoc($getCategory); ) {
                                ?>
                                <option selected> <?php echo $cat['category'] ?></option>
                                <?php
                              }

                            } else {
                              echo "no record found";

                            }
                            ?>

                          </select>
                        </div>

                        <div class="col-md-3 m-3">
                          <label for="">Blog Author</label>
                          <input type="text" class="form-control" name="blgAuth" id="blgAuth" onfocus="hideError(this)"
                            onblur="showError(this)" value="<?php echo $row['author'] ?>" />
                        </div>

                        <div class="col-md-3 m-3">
                          <label for="formFile" class="form-label">Blog Image</label>
                          <img style="width: 50px;" src="<?php echo $row['img'] ?>" />
                        </div>

                        <div class="col-md-6 m-3">
                          <label for="">Blog Description</label>
                          <textarea class="form-control" name="blgDes" id="editor"
                            value="<?php echo $row['description'] ?>"></textarea>
                        </div>

                        <div class="col-md-4 m-3">
                          <input type="submit" class="btn btn-success" name="updateBlog" value="Update" />
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
    ClassicEditor
      .create(document.getElementById('editor'))
      .catch(error => {
        console.error(error);
      });
  </script>
  <script>
    function checkValidation() {
      var blogTitle = document.getElementById('blogTitle');
      if (blogTitle.value.trim() == "") {
        blogTitle.style.cssText = "border:2px solid red";
        return false;
      }

      var blgAuth = document.getElementById('blgAuth');
      if (blgAuth.value.trim() == "") {
        blgAuth.style.cssText = "border:2px solid red";
        return false;
      }

      var blgAuth = document.getElementById('blgAuth');
      if (blgAuth.value.trim() == "") {
        blgAuth.style.cssText = "border:2px solid red";
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