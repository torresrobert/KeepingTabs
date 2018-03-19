<?php
//including the database connection file

include_once("../includes/dbh.inc.php");
session_start();
//getting id of the data from url
$tran_id = $_GET['id'];
$result = mysqli_query($conn, "DELETE FROM `Transaction` WHERE `TransactionID` = '$tran_id'");
header("Location: journalize.php");


?>
