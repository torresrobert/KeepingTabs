<?php

session_start();

if (isset($_POST['submit'])) {
	include 'dbh.inc.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

//Error handlers
//Check if inputs are empty
	if (empty($username) || empty($password)) {
		header("Location: ../login.php?login=empty");
		echo "empty";
		exit();
	} else {
		$sql = "SELECT * FROM Users WHERE username = '$username'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../login.php?login=error_user_not_found");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
//De-hashing the password
				$hashedPwdCheck = password_verify($password, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../login.php?login=error_password");
					exit();
				} elseif ($hashedPwdCheck == true) {
//Log in the user here
					$_SESSION['u_uid'] = $row['username'];
					$_SESSION['u_first'] = $row['firstName'];
					$_SESSION['u_last'] = $row['lastName'];
					$_SESSION['u_atype'] = $row['accountType'];
					$_SESSION['u_isactive'] = $row['isActive'];
					header("Location: ../user/user.php?login=success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../login.php?login=error");
	exit();
}