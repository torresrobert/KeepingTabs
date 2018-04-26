<?php
//including the database connection file

include_once("../includes/dbh.inc.php");
include_once 'user.header.php';
session_start();
//getting id of the data from url
$e_id = $_GET['id'];
$curr_date = date('Y-m-d');

//fetches date the transaction was submitted
$query = mysqli_query($conn,"SELECT Date from JournalEntry WHERE EntryID = $e_id");
//array that holds the date of the entry submission at index 0
$currEntry = mysqli_fetch_row($query);
$entryDate = $currEntry[0];


//include '../includes/dbh.inc.php';
$sql = "SELECT * FROM Transaction WHERE JournalID = '31' AND EntryID = '$e_id'";
$records = mysqli_query($conn, $sql);
while( $row = mysqli_fetch_assoc($records) ) {
  //query to access items inside of financial accounts bassed on current account name
  $query = mysqli_query($conn,"SELECT accountNumber, NormalSide from FinancialAccounts where accountName = '$row[AccountName]'");
  $item = mysqli_fetch_row($query);
// holds current account number
  $accountNum = $item[0];
  //sets variable equal to amount of each transaction before adjusting for normal debits and credits
  $change_balance = $row['Amount'];
  //corrects normal sides
  $normalSide = $item[1];
  if ($normalSide == "debit" && $row['Side']== "Credit"){
      $change_balance = $change_balance*-1;
  }else if ($normalSide == "credit" && $row['Side']== "Debit"){
      $change_balance = $change_balance *-1;
  }

echo "$entryDate";
  mysqli_query($conn, "INSERT INTO Ledger (AccountID, TransactionID, `Date`) VALUES ($accountNum, $row[TransactionID], '$entryDate')");

  mysqli_query($conn, "UPDATE Ledger SET BalanceAfterTransaction = (BalanceAfterTransaction + $change_balance) WHERE `Date` >= $entryDate AND AccountID = $accountNum");


 $sql = "UPDATE FinancialAccounts SET Balance = (SELECT BalanceAfterTransaction From Ledger WHERE AccountID = $accountNum AND Date = (SELECT MAX(Date) from Ledger WHERE AccountID = $accountNum)) WHERE AccountID = $accountNum";
   echo "$sql";
mysqli_query($conn, $sql);



  //mysqli_query($conn, "UPDATE FinancialAccounts SET Balance = (SELECT BalanceAfterTransaction FROM Ledger JOIN Transaction on Ledger.TransactionID = Transaction.TransactionID JOIN JournalEntry on Transaction.EntryID = JournalEntry.EntryID WHERE Transaction.AccountName = $row[AccountName] and JournalEntry.Date = (Select MAX(JournalEntry.Date) from JournalEntry JOIN Transaction ON Transaction.EntryID = JournalEntry.EntryID JOIN Ledger ON Ledger.TransactionID = Transaction.TransactionID WHERE Ledger.AccountID = $accountNum)) WHERE accountName = $row[AccountName]");
}


$approve_entry = "UPDATE `JournalEntry` SET `Approved` = 'approved' WHERE `EntryID` = '$e_id'";
$curr_account = mysqli_query($conn, $approve_entry);

//header("Location: journal.php");

?>
<?php
include_once 'user.footer.php';
?>
