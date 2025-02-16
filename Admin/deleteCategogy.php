<?php
include("conn.php");
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
  $token = $_REQUEST['id'];
  echo $token;
  echo mysqli_error($con);
}
?>