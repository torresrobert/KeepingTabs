<?php
include_once("../includes/dbh.inc.php");
$sql = "UPDATE Users set ".$_REQUEST["column"]."='".$_REQUEST["value"]."' WHERE  id='".$_REQUEST["id"]."'";
mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
echo "saved";
