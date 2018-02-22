<?php
//including the database connection file

include_once("../includes/dbh.inc.php");
session_start();
//getting id of the data from url
$username = $_GET['id'];
if (($_SESSION['u_atype']=='admin')){
  $result = mysqli_query($conn, "DELETE FROM Users WHERE username = '$username'");
}else {
  header("Location: user_dir.php?error=privileges");
  exit();
}

header("Location: user_dir.php");

?>
