<?php
include_once 'user.header.php'
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Balance Sheet</h1>
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
      <div id="new-search-area"></div>
      <table id="balance_sheet" class="table table-striped special-bordered" cellspacing="0" width="100%">
   <thead>
     <tr class="primary">
       <th scope="col">Assets</th>
       <th scope="col">  </th>
       <th scope="col">  </th>
     </tr>
   </thead>
   <tbody>
     <?php
     $row_count = 0;
     $total = 0;
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
         $total+=$row['Balance'];
      }else {
        if ($row['Balance']>0){
        echo "<td><p class='text-right'> ".number_format($row['Balance'],2)."</p></td>";
      }elseif ($row['Balance']<0) {
        echo "<td><p class='text-right'> (".number_format(abs($row['Balance']),2).")</p></td>";
      }
        $row_count++;
        $total+=$row['Balance'];
   }
      echo "<td> </td>";


     }
      echo "<tr>";
      echo "  <td> <strong>Total Assets</strong></td>";
        echo "<td> </td>";

        if ($total>0){
          echo "<td class='text-right'><u>$ ".number_format($total,2)."</u></td>";
        }elseif ($total<0){
          echo "<td class='text-right'><u>$ (".number_format($total,2).")</u></td>";
        }
      ?>
<tr><td></td><td></td><td></td>
   </tbody>
  </table>
<!--Liabilites--><!--Liabilites--><!--Liabilites--><!--Liabilites-->
   <?php
   include '../includes/dbh.inc.php';
   $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'liabilities') ORDER BY AccountID";
   $records = mysqli_query($conn, $sql);
   ?>


       <table id="balance_sheet" class="table table-striped special-bordered" cellspacing="0" width="100%">
    <thead>
      <tr class="primary">
        <th scope="col">Liabilites</th>
        <th scope="col">  </th>
        <th scope="col">  </th>
      </tr>
    </thead>
    <tbody>
      <?php
      $row_count = 0;
      $totalLiabilities = 0;
      while ($row = mysqli_fetch_assoc($records)) {
        echo "<tr class='clickable-row' data-href='url://'>";
        echo  "<td>".$row['AccountName']."</td>";
        if ($row_count == 0){
          echo "<td><p class='text-right'>".number_format($row['Balance'],2)."</p></td>";
          $row_count++;
          $totalLiabilities +=$row['Balance'];
       }else {
         echo "<td><p class='text-right'>".number_format($row['Balance'],2)."</p></td>";
         $row_count++;
         $totalLiabilities +=$row['Balance'];
    }
    echo "<td> </td>";

      }
      echo "<tr>";
      echo "  <td> <strong>Total Liabilites</strong></td>";
        echo "<td> </td>";

        if ($totalLiabilities>0){
          echo "<td class='text-right'><u>$ ".number_format($totalLiabilities,2)."</u></td>";
        }elseif ($totalLiabilities<0){
          echo "<td class='text-right'><u>$ (".number_format($totalLiabilities,2).")</u></td>";
        }


      ?>
  <tr><td></td><td></td><td></td>
    </tbody>
   </table>
   <!--Owner's Equity--><!--Owner's Equity--><!--Owner's Equity-->
   <?php
   include '../includes/dbh.inc.php';
   $sql = "SELECT AccountName, Balance, AccountType from FinancialAccounts where (Balance < 0 OR Balance > 0) AND (AccountType = 'owners_equity') ORDER BY AccountID";
   $records = mysqli_query($conn, $sql);
   ?>


       <table id="balance_sheet" class="table table-striped special-bordered" cellspacing="0" width="100%">
    <thead>
      <tr class="primary">
        <th scope="col">Owner's Equity</th>
        <th scope="col">  </th>
        <th scope="col">  </th>
      </tr>
    </thead>
    <tbody>
      <?php
      $row_count = 0;
      $totalOE = 0;
      while ($row = mysqli_fetch_assoc($records)) {
        echo "<tr class='clickable-row' data-href='url://'>";
        echo  "<td>".$row['AccountName']."</td>";
        if ($row_count == 0){
          echo "<td><p class='text-right'>".number_format($row['Balance'],2)."</p></td>";
          $row_count++;
          $totalOE +=$row['Balance'];
       }else {
         echo "<td><p class='text-right'>".number_format($row['Balance'],2)."</p></td>";
         $row_count++;
         $totalOE +=$row['Balance'];
    }
echo "<td> </td>";
      }
      echo "<tr>";
      echo "  <td>Total Owner's Equity</td>";
        echo "<td> </td>";

        if ($totalOE>0){
          echo "<td class='text-right'><u>$ ".number_format($totalOE,2)."</u></td>";
        }elseif ($totalOE<0){
          echo "<td class='text-right'><u>$ (".number_format($totalOE,2).")</u></td>";
        }

      $total = $totalLiabilities+$totalOE;
      echo "<tr><td></td><td></td><td></td>";
      echo "<tr>";
      echo "  <td> <strong>Total Liabilites & Owner's Equity</strong></td>";
        echo "<td> </td>";
      //  echo "<td class='text-right'><span class='doubleUnderline'><strong>$ ".$total."</span></strong></td>";

        if ($total>0){
          echo "<td class='text-right'><span class='doubleUnderline'>$ ".number_format($total,2)."</span></td>";
        }elseif ($total<0){
          echo "<td class='text-right'><span class='doubleUnderline'>$ (".number_format($total,2).")</span></td>";
        }

       ?>
    </tbody>
   </table>
    </div>



<?php
include_once 'user.footer.php'
?>
