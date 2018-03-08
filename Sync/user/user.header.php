<?php
//session_start();
include_once("../includes/dbh.inc.php");
session_start();
if (!isset($_SESSION['u_uid'])){
	session_unset();
	session_destroy();
	header("Location: ../index.php?error_login_failed");
	die();

}

?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.0.0/dt-1.10.16/datatables.min.css"/>
  <link rel="stylesheet" href="user.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	<script type="text/javascript" src="../script/functions.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-md bg-primary navbar-dark nav-fill">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="user.php">KeepingTabs</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item mr-auto">
            <a class="nav-link text-white" href="chart_of_accounts.php">Chart of Accounts</a>
          </li>
          <li class="nav-item mr-auto">
            <a class="nav-link disabled" href="#">Accounts</a>
          </li>
          <li class="nav-item mr-auto">
            <a class="nav-link disabled" href="#">Logs</a>
          </li>
          <li class="nav-item mr-auto">
            <a class="nav-link disabled" href="#">Categories</a>
          </li>
          <li class="nav-item mr-auto">
            <a class="nav-link disabled" href="#">Normal Sides</a>
          </li>
          <li class="nav-item mr-auto">
            <a class="nav-link text-white" href="user_dir.php">Users</a>
          </li>
					<li class="nav-item mr-auto">
            <a class="nav-link text-white" href="documentation.php">Documentation</a>
          </li>
        </ul>
        <form class="form-inline mr-auto">
          <input class="form-control mr-2" type="text" placeholder="Search">
          <button class="btn btn-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
		<div>
    <form action="../includes/logout.inc.php" method="POST">
    <button class="btn btn-default navbar-btn btn-warning" type="submit" name="submit" >Log out</button>
</form>
</div>
  </nav>
