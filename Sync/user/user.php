<?php
include_once 'user.header.php';
?>
<div class="jumbotron">
  <h1 class="display-4">Welcome back, <?php $firstName = $_SESSION['u_first']; echo $firstName; ?>!</h1>
  <p class="lead">
  <div class="alert alert-success" role="alert">
  There are currently no pending requests. Please feel free to explore all of the system functions.
</div></p>
  <hr class="my-4">
  <p>If something is unclear please feel free to explore the documentation section.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="documentation.php" role="button">Learn more</a>
  </p>
</div>

<!--If time optimize!!-->

<?php
include '../includes/dbh.inc.php';
$sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'revenue') ORDER BY AccountID";
$records = mysqli_query($conn, $sql);
   while ($row = mysqli_fetch_assoc($records)) {
       $totalRevenues+=$row['Balance'];
 }
    ?>
 <?php
 include '../includes/dbh.inc.php';
 $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'expense') ORDER BY AccountID";
 $records = mysqli_query($conn, $sql);
    $row_count = 0;
    $totalExpenses = 0;
    while ($row = mysqli_fetch_assoc($records)) {
        $totalExpenses+=$row['Balance'];
}

$profit = $totalRevenues-$totalExpenses;
     ?>
     <?php
     include '../includes/dbh.inc.php';
     $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'owners_equity') ORDER BY AccountID";
     $records = mysqli_query($conn, $sql);
        $row_count = 0;
        $totalEquity = 0;
        while ($row = mysqli_fetch_assoc($records)) {
            $totalEquity+=$row['Balance'];
    }

         ?>
     <?php
     include '../includes/dbh.inc.php';
     $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'assets') ORDER BY AccountID";
     $records = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($records)) {
            $totalAssets+=$row['Balance'];
          //  echo "$totalAssets"."<br>";
      }
         ?>

         <?php
         include '../includes/dbh.inc.php';
         $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'assets') AND (accountSubType = 'Short Term') ORDER BY AccountID";
         $records = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($records)) {
                $currAssets+=$row['Balance'];
              //  echo "$totalAssets"."<br>";
          }
             ?>
             <?php
             include '../includes/dbh.inc.php';
             $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'liabilities') AND (accountSubType = 'Short Term') ORDER BY AccountID";
             $records = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($records)) {
                    $currLiabilities+=$row['Balance'];
                  //  echo "$totalAssets"."<br>";
              }
                 ?>
                 <?php
                 include '../includes/dbh.inc.php';
                 $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where accountName = 'Supplies' ORDER BY AccountID";
                 $records = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($records)) {
                        $inventory+=$row['Balance'];
                      //  echo "$totalAssets"."<br>";
                  }
                     ?>
<!--Ratios---><!--Ratios---><!--Ratios---><!--Ratios---><!--Ratios---><!--Ratios---><!--Ratios--->

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php $str = $profit/$totalAssets; $roa = round((float)$str * 100 ) . '%'; echo "$roa"; ?>  <a class="btn btn-primary btn-lg"></a></h2>
        <p class="card-text"><b>ROA</b>  = Net Profit / Total Assets</p>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php $str = $profit/$totalEquity; $roa = round((float)$str * 100 ) . '%'; echo "$roa"; ?>  <a class="btn btn-primary btn-lg"></a></h2>
        <p class="card-text"><strong>ROE</strong> = Net Profit / Total Equity</p>
      </div>
    </div>
  </div>
</div>




<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php $str = $currAssets/$currLiabilities; $cr = round((float)$str * 100 ) . '%'; echo "$cr"; ?>  <a class="btn btn-primary btn-lg"></a></h2>
        <p class="card-text"><strong>CR</strong> = Current Assets / Current Liabilities </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php $str = ($currAssets - $inventory)/$currLiabilities; $cr = round((float)$str * 100 ) . '%'; echo "$cr"; ?>  <a class="btn btn-primary btn-lg"></a></h2>
        <p class="card-text"><strong>QR</strong> = Current Assets - Inventory / Current Liabilities </p>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php $str = $totalRevenues/$totalAssets; $at = round((float)$str * 100 ) . '%'; echo "$at"; ?>   <a class="btn btn-primary btn-lg"></a></h2>
        <p class="card-text"><strong>AT</strong> = Sales / Total Assets</p>
      </div>
    </div>
  </div>
</div>


<!--Charts--->




<?php
include_once 'user.footer.php';
?>
