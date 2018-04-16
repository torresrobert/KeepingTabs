<?php
//including the database connection file

include_once("../includes/dbh.inc.php");
include_once 'user.header.php';
session_start();
//getting id of the data from url
$e_id = $_GET['id'];
//Sinclude '../includes/dbh.inc.php';
$sql = "SELECT * FROM Transaction WHERE JournalID = '31' AND EntryID = '$e_id'";
$records = mysqli_query($conn, $sql);
while( $row = mysqli_fetch_assoc($records) ) {


  $sql_account = "SELECT * FROM `FinancialAccounts` WHERE `accountName` = '$row[AccountName]'";
  $curr_account = mysqli_query($conn, $sql_account);
  $row_curr_account = mysqli_fetch_array($curr_account);


  $sql_entry = "SELECT * FROM `JournalEntry` WHERE `EntryID` = '$row[EntryID]'";
  $curr_entry = mysqli_query($conn, $sql_entry);
  $row_curr_entry = mysqli_fetch_array($curr_entry);

  //echo "$row[Amount]";
  $curr_balance = $row_curr_account[8];
  if($row['Side']=="Credit"){
    $change_balance = (-1 * $row['Amount']);
    echo "i want to add a negative balance of ".(-1*$row['Amount'])." from the initial balance of ".$curr_balance;
}else {
    $change_balance = $row['Amount'];
    echo "i want to add a balance of ".($row['Amount'])." to the initial balance of ".$curr_balance;
}
echo "CURRENT CHANGE IS: ".$change_balance;
echo "current balance:".$curr_balance;
$new_balance = $change_balance + $curr_balance;

  $sql = "INSERT Into `Ledger` (AccountID, TransactionID, BalanceAfterTransaction, Date) VALUES ($row_curr_account[0], $row[TransactionID], $new_balance, $row_curr_entry[1])";
  mysqli_query($conn, $sql);
  echo "accountID";
  echo "$row_curr_account[0]";
  echo " transactionID:";
  echo "$row[TransactionID]";
  echo " balance:";
  echo "$new_balance";
  echo " date:";
  echo "$row_curr_entry[1]";


  $sql_update_balance = "UPDATE FinancialAccounts SET Balance = '$new_balance' WHERE AccountID = '$row_curr_account[0]'";
  mysqli_query($conn, $sql_update_balance);
}

$approve_entry = "UPDATE `JournalEntry` SET `Approved` = 'approved' WHERE `EntryID` = '$e_id'";
$curr_account = mysqli_query($conn, $approve_entry);

header("Location: journal.php");

?>
<?php
include_once 'user.footer.php';
?>
