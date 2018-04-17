<?php
//including the database connection file
include_once 'user.header.php';

session_start();
  include '../includes/dbh.inc.php';
$AccoutNumber = $_GET['id'];

$sql = "SELECT * FROM FinancialAccounts WHERE AccountID = '$AccoutNumber'";
$records = mysqli_query($conn, $sql);
$curr_account = mysqli_fetch_row($records);
$AccountName = $curr_account[1];
?>


<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4"><?php echo $AccoutNumber."  -  ".$AccountName; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="text-white" target="_blank">Missing something? You can request a new account here.</a>
        </div>
      </div>
    </div>
  </div>
<!--add new account-->
<nav class="navbar navbar-light bg-light">
  <a class="btn btn-outline-primary span4" href="chart_of_accounts.php" role="button"><i class="	fa fa-chevron-left"></i> Chart of Accounts</a>

</nav>

<!--display table-->

<div class="container">
  <?php
  include '../includes/dbh.inc.php';
  $sql = "SELECT JournalEntry.EntryID, JournalEntry.Date, JournalEntry.Description, Transaction.Amount, Transaction.Side, Ledger.BalanceAfterTransaction From JournalEntry JOIN Transaction ON JournalEntry.EntryID = Transaction.EntryID JOIN Ledger ON Transaction.TransactionID = Ledger.TransactionID WHERE Transaction.AccountName = '$AccountName'";
  $curr_trans = mysqli_query($conn, $sql);
  ?>
  <div class="container">
    <div class="table-responsive">
      <div id="new-search-area"></div>
      <table id='account_view' class='table table-striped table-bordered' cellspacing='0' width='100%'>
        <thead>
          <tr class='primary'>
            <th scope='col'>EntryID</th>
            <th scope='col'>Date</th>
            <th scope='col'>Description</th>
            <th scope='col'>Amount</th>
            <th scope='col'>Side</th>
            <th scope='col'>Balance</th>

          </tr>
        </thead>
        <tbody>
          <?php
          while( $row = mysqli_fetch_assoc($curr_trans) ) {
            ?>
            <tr class='clickable-row' data-href='url://'>
              <?php
              echo "<th scope='row'><a href='view_entry.php?id=$row[EntryID]'>".$row['EntryID']."</a></th>";
              echo '<td>'.$row['Date'].'</td>';
              echo '<th>'.$row['Description'].'</td>';
              echo "<th><p class='text-right'>$".number_format($row['Amount'],2)."</p></td>";
              echo '<th>'.$row['Side'].'</td>';
              echo "<th><p class='text-right'>$".number_format($row['BalanceAfterTransaction'],2)."</p></td>";
              ?>


            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
</div>
<?php

include_once 'user.footer.php';
?>
