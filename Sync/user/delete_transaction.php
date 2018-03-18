<?php
//including the database connection file

include_once("../includes/dbh.inc.php");
session_start();
//getting id of the data from url
$e_id = $_GET['id'];
if (($_SESSION['u_atype']=='admin')){
  $result = mysqli_query($conn, "DELETE FROM `Transaction` WHERE `Transaction`.`TransactionID` = '$e_id'");
}else {
  header("Location: journalize.php?error=privileges");
  exit();
}
//header("Location: journalize.php");

?>
