<?php
//session_start();
ob_start();
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
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="src/logo.png" />
	<link rel="icon" href="/src/logo.ico">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<title>KeepingTabs</title>
	<link rel="stylesheet" href="user.css" type="text/css">

	<script type="text/javascript" src="../script/functions.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>



</head>

<body>
	<nav class="navbar navbar-expand-md bg-primary navbar-dark nav-fill">
		<div class="container-fluid">
			<a class="navbar-brand text-white" href="user.php">KeepingTabs</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown text-white">
						<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Accounts
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="chart_of_accounts.php">Chart of Accounts</a>
							<a class="dropdown-item" href="accounts.php">Accounts</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item disabled" href="#">Categories</a>
							<a class="dropdown-item disabled" href="#">Normal Sides</a>
						</div>
					</li>
					<li class="nav-item dropdown text-white">
						<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Journal
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<!--Sends user to default journal, the general journal-->
						<form action="journalize.php?id=31" method="POST">
							<button class="dropdown-item" type='new_entry' name='new_entry'>Journalize</button>
						</form>

							<a class="dropdown-item" href="journal.php">Journals</a>
						</div>
					</li>
					<li class="nav-item dropdown text-white">
						<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Users
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="user_dir.php">User Directory</a>
							<a class="dropdown-item" href="activity_logs.php">Logs</a>
						</div>
					</li>
					<li class="nav-item mr-auto">
						<a class="nav-link text-white" href="documentation.php">Get Support</a>
					</li>
				</ul>
				<form class="form-inline mr-auto" action="search.php" method="GET">
					<input class="form-control mr-2" type="text" name="query" placeholder="Search">
					<button class="btn btn-primary" value="Search" type="submit">Search</button>
				</form>
			</div>
		</div>
		<div>
			<form action="../includes/logout.inc.php" method="POST">
				<button class="btn btn-default navbar-btn btn-warning" type="submit" name="submit" >Log out</button>
			</form>
		</div>
	</nav>
