<?php
include_once 'user.header.php'
?>

<div class="text-center bg-primary text-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="display-4">Retained Earnings</h1>
        <br>
        <h1>Ending on <?php
        $number = date("t");
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if (($number %100) >= 11 && ($number%100) <= 13)
        $abbreviation = $number. 'th';
        else
        $abbreviation = $number. $ends[$number % 10];
        echo $abbreviation;
        ?>
        of April</h1>

      </div>
    </div>
    <div class="row">

    </div>
  </div>
</div>
<!--add new account-->
<nav class="navbar navbar-light bg-light">
</nav>
<!--display table-->

<?php
include '../includes/dbh.inc.php';
$sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'assets') ORDER BY AccountID";
$records = mysqli_query($conn, $sql);
?>

<div class="container">
  <div class="table-responsive">
    <table id="balance_sheet" class="table table-striped special-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="primary">
          <th scope="col"></th>
          <th scope="col"> </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $row_count = 0;
        $totalExpenses = 0;

        $beginOM = date("m-1-Y");
        echo "<tr>";
        echo "  <td> <strong><strong>Begining Retained Earnings, ".$beginOM."</strong></strong></td>";
        echo "<td class='text-right'>$".$totalExpenses."</td>";

        $total=$totalExpenses+$totalRevenues;

        echo "<tr>";
        echo "  <td> <strong><strong>Add: Net Income</strong></td>";
        echo "<td class='text-right'>$ ".$total."</td>";

        $endOM = date("m-t-Y");
        echo "<tr>";
        echo "  <td> <strong><strong>Less: Dividends</strong></strong></td>";
        echo "<td class='text-right'><u>$ ".$total."</u></td>";

        echo "<tr>";
        echo "  <td> <strong><strong>End Retained Earnings, ".$endOM."</strong></strong></td>";
        echo "<td class='text-right'><span class='doubleUnderline'>$ ".$total."</span></td>";
        ?>

      </tbody>
    </table>
  </div>



  <?php
  include_once 'user.footer.php'
  ?>
