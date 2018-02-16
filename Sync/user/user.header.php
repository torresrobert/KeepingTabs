<?php
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
  <link rel="stylesheet" href="user.css" type="text/css"> </head>

<body>
  <nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
      <a class="navbar-brand text-white" href="user.php">KeepingTabs</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="chart_of_accounts.php">Chart of Accounts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Accounts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Logs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Normal Sides</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Users</a>
          </li>
        </ul>
        <form class="form-inline m-0">
          <input class="form-control mr-2" type="text" placeholder="Search">
          <button class="btn btn-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
    <form action="includes/logout.inc.php" method="POST">
    <button class="btn btn-default navbar-btn btn-warning" type="submit" name="submit" >Log out</button>
</form>
  </nav>
