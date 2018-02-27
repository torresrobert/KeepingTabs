<?php
//including the database connection file

include_once("../includes/dbh.inc.php");
session_start();
//getting id of the data from url
$accountNumber = $_GET['id'];
if (($_SESSION['u_atype']=='admin')){
  $result = mysqli_query($conn, "DELETE FROM FinancialAccounts WHERE accountNumber = ".$accountNumber);
}else {
  header("Location: chart_of_accounts.php?error=privileges");
  exit();
}

header("Location: chart_of_accounts.php");

?>
