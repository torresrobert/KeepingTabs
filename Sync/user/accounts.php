<?php
include_once 'user.header.php'
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Accounts</h1>
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
    <?php
    if (($_SESSION['u_atype']=='admin')||($_SESSION['u_atype']=='manager')){
    echo '<a class="btn btn-primary btn span4" href="add_account.php" role="button">Add new account</a>';
   }
   ?>
</nav>
<!--display table-->

  <?php
  include '../includes/dbh.inc.php';
  $sql = "SELECT * FROM FinancialAccounts";
  $records = mysqli_query($conn, $sql);
  ?>

  <div class="container">
    <div class="table-responsive">
      <div id="new-search-area"></div>
      <table id="accounts" class="table table-striped table-bordered" cellspacing="0" width="100%">
   <thead>
     <tr class="primary">
       <th scope="col">Account Number</th>
       <th scope="col">Account Name</th>
       <th scope="col">Account Type</th>
       <th scope="col">Account Sub Type</th>
       <th scope="col">Active</th>
       <th scope="col">Normal Side</th>
       <th scope="col">Balance</th>
       <?php
       if (($_SESSION['u_atype']=='admin')){
       echo '<th scope="col">Update</th>';
     }
     $row_count = 0;
  ?>

   <th scope="col">Created On</th>
     </tr>
   </thead>
   <tbody>
     <?php
     while ($employee = mysqli_fetch_assoc($records)) {
       echo "<tr>";
       echo "<th scope='row'><a href='account_view.php?id=$employee[AccountID]'>".$employee['accountNumber']."</a></th>";
       echo  "<td>".$employee['accountName']."</td>";
       echo "<td>".ucwords(str_replace('_', ' ',$employee['accountType']))."</td>";
       echo "<td>".ucwords(str_replace('_', ' ',$employee['accountSubType']))."</td>";
       if ($employee['isActive']){
         echo "<td>Yes</td>";
       }else {
         echo "<td>No</td>";
       }


       echo "<td>".ucwords($employee['NormalSide'])."</td>";


       if ($row_count == 0){
       echo "<td><p class='text-right'>$".number_format($employee['Balance'],2)."</p></td>";
       $row_count++;
     }else {
     echo "<td><p class='text-right'>".number_format($employee['Balance'],2)."</p></td>";
     $row_count++;
   }

       if (($_SESSION['u_atype']=='admin')){
       echo "<td><a href=\"edit_account.php?id=$employee[AccountID]\">Edit</a> | <a href=\"delete_account.php?id=$employee[AccountID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
     }
      echo "<td>".$employee['createdOn']."</td>";
       echo "</tr>";
     }
      ?>
   </tbody>
  </table>
   </div>



<?php
include_once 'user.footer.php'
?>
