<?php

if(isset($_POST['submit'])){

	include_once 'dbh.inc.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	
	//Error handlers
	//Check for empty fields
	if (empty($username) || empty($password) || empty($firstName) || empty($lastName)) {
		header("Location: ../create-account.php");
		exit();
		
	}else{
		//check if input characters are valid
		if(!preg_match("/^[a-zA-Z]*$/", $firstName)||!preg_match("/^[a-zA-Z]*$/", $lastName)){
			header("Location: ../create-account.php?signup=invalid");
			exit();
		}else{
			//check if username is taken
			$sql = "SELECT * FROM Users WHERE username='$username'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				header("Location: ../create-account.php?sign-up=usertaken");
				exit();
			}else{
				//hashing the password
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
				//insert user into database
				$sql = "INSERT INTO Users (username, password, firstName, lastName) VALUES ('$username', '$hashedPwd', '$firstName', '$lastName');";
				mysqli_query($conn, $sql);
				header("Location: ../create-account.php?signup-success");
				exit();
}
}
}
}
 else {
	header("Location: ../create-account.php");
	exit();
}


