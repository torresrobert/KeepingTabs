<?php
include_once 'user.header.php'
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Income Statement</h1>
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

<!--revenues--><!--revenues--><!--revenues--><!--revenues-->

  <?php
  include '../includes/dbh.inc.php';
  $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'revenue') ORDER BY AccountID";
  $records = mysqli_query($conn, $sql);
  ?>

  <div class="container">
    <div class="table-responsive">
      <div id="new-search-area"></div>
      <table id="balance_sheet" class="table table-striped table-bordered" cellspacing="0" width="100%">
   <thead>
     <tr class="primary">
       <th scope="col">Revenues</th>
       <th scope="col">  </th>
     </tr>
   </thead>
   <tbody>
     <?php
     $row_count = 0;
     $totalRevenues = 0;
     while ($row = mysqli_fetch_assoc($records)) {
       echo "<tr class='clickable-row' data-href='url://'>";
       echo  "<td>".$row['AccountName']."</td>";
       if ($row_count == 0){
         if ($row['Balance']>0){
         echo "<td><p class='text-right'>$ ".number_format($row['Balance'],2)."</p></td>";
       }elseif ($row['Balance']<0) {
         echo "<td><p class='text-right'>$ (".number_format(abs($row['Balance']),2).")</p></td>";
       }
         $row_count++;
         $totalRevenues+=$row['Balance'];
      }else {
        if ($row['Balance']>0){
        echo "<td><p class='text-right'> ".number_format($row['Balance'],2)."</p></td>";
      }elseif ($row['Balance']<0) {
        echo "<td><p class='text-right'> (".number_format(abs($row['Balance']),2).")</p></td>";
      }
        $row_count++;
        $totalRevenues+=$row['Balance'];
   }


     }
      echo "<tr>";
      echo "  <td> <strong>Total Revenues</strong></td>";
        echo "<td class='text-right'><span class='doubleUnderline'>$ ".$totalRevenues."</span></td>";
      ?>

   </tbody>
  </table>
<!--Expenses--><!--Expenses--><!--Expenses--><!--Expenses-->
   <?php
   include '../includes/dbh.inc.php';
   $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'expenses') ORDER BY AccountID";
   $records = mysqli_query($conn, $sql);
   ?>


       <table id="balance_sheet" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr class="primary">
        <th scope="col">Expenses</th>
        <th scope="col">  </th>
      </tr>
    </thead>
    <tbody>
      <?php
      $row_count = 0;
      $totalExpenses = 0;
      while ($row = mysqli_fetch_assoc($records)) {
        echo "<tr class='clickable-row' data-href='url://'>";
        echo  "<td>".$row['AccountName']."</td>";
        if ($row_count == 0){
          if ($row['Balance']>0){
          echo "<td><p class='text-right'>$ ".number_format($row['Balance'],2)."</p></td>";
        }elseif ($row['Balance']<0) {
          echo "<td><p class='text-right'>$ (".number_format(abs($row['Balance']),2).")</p></td>";
        }
          $row_count++;
          $totalExpenses+=$row['Balance'];
       }else {
         if ($row['Balance']>0){
         echo "<td><p class='text-right'> ".number_format($row['Balance'],2)."</p></td>";
       }elseif ($row['Balance']<0) {
         echo "<td><p class='text-right'> (".number_format(abs($row['Balance']),2).")</p></td>";
       }
         $row_count++;
         $totalExpenses+=$row['Balance'];
    }


      }
      echo "<tr>";
      echo "  <td> <strong>Total Expenses</strong></td>";
        echo "<td class='text-right'><span class='doubleUnderline'>$".$totalExpenses."</span></td>";
      $total=$totalExpenses+$totalRevenues;
        echo "<tr>";
        echo "  <td> <strong><strong>Net Income (Loss)</strong></strong></td>";
          echo "<td class='text-right'><span class='doubleUnderline'>$ ".$total."</span></td>";
       ?>
    </tbody>
   </table>
    </div>



<?php
include_once 'user.footer.php'
?>
