<?php
include_once("../includes/dbh.inc.php");
if (isset($_POST['submit'])){
	session_start();
	$e_id = $_SESSION['e_id'];


	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'xls', 'csv');

	if(in_array($fileActualExt, $allowed)) {
		if($fileError === 0) {
			if ($fileSize < 5000000) { //maximum file size
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$sql = "UPDATE JournalEntry SET AttachmentFile = '$fileDestination' WHERE EntryID = '$e_id'";
				mysqli_query($conn, $sql);


			} else {
				echo "Your file is too big";
			}

		} else {
			echo "There was an error uploading your file";
		}

	} else {
		echo "You cannot upload files of this type";
	}
}
header("Location: journalize.php");
echo "File successfully uploaded";
