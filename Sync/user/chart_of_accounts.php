<?php
include_once 'user.header.php'
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Chart of Accounts</h1>
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
    if (($_SESSION['u_atype']=='admin')){
    echo '<a class="btn btn-primary btn span4" href="add_account.php" role="button">Add new account</a>';
   }
   ?>
<!--search function-->
<form class="form-inline">

  <div class="input-group">

    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"> <img src="../assets/icons/si-glyph-magnifier.svg"/ width="15" height="15">

</span>

    </div>
      <input type="text" class="light-table-filter" data-table="order-table" placeholder="Search" class="form-control" aria-label="search" aria-describedby="basic-addon1">
  </div>

</form>
</nav>
<!--display table-->

  <?php
  include '../includes/dbh.inc.php';
  $sql = "SELECT * FROM FinancialAccounts";
  $records = mysqli_query($conn, $sql);
  ?>

  <div class="container" style="text-align:center">
     <table id="chart_of_account" class="order-table table-responsive table table-hover">
   <thead>
     <tr class="primary">
       <th scope="col">Account Number</th>
       <th scope="col">Account Name</th>
       <th scope="col">Account Type</th>
       <th scope="col">Active</th>
       <th scope="col">Normal Side</th>
       <th scope="col">Balance</th>
       <?php
       if (($_SESSION['u_atype']=='admin')){
       echo '<th scope="col">Update</th>';
     }
  ?>
   <th scope="col">Created On</th>
     </tr>
   </thead>
   <tbody>
     <?php
     while ($employee = mysqli_fetch_assoc($records)) {
       echo "<tr class='clickable-row' data-href='url://'>";
       echo '<th scope="row">'.$employee['accountNumber']."</th>";
       echo  "<td>".$employee['accountName']."</td>";
       echo "<td>".$employee['accountType']."</td>";
       if ($employee['isActive']){
         echo "<td>True</td>";
       }else {
         echo "<td>False</td>";
       }


       echo "<td>".$employee['NormalSide']."</td>";
       echo "<td>".$employee['Balance']."</td>";
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

   <script>
   (function(document) {
    "use strict";

    var LightTableFilter = (function(Arr) {
      var _input;

      function _onInputEvent(e) {
        _input = e.target;
        var tables = document.getElementsByClassName(
          _input.getAttribute("data-table")
        );
        Arr.forEach.call(tables, function(table) {
          Arr.forEach.call(table.tBodies, function(tbody) {
            Arr.forEach.call(tbody.rows, _filter);
          });
        });
      }

      function _filter(row) {
        var text = row.textContent.toLowerCase(),
            val = _input.value.toLowerCase();
        row.style.display = text.indexOf(val) === -1 ? "none" : "table-row";
      }

      return {
        init: function() {
          var inputs = document.getElementsByClassName("light-table-filter");
          Arr.forEach.call(inputs, function(input) {
            input.oninput = _onInputEvent;
          });
        }
      };
    })(Array.prototype);

    document.addEventListener("readystatechange", function() {
      if (document.readyState === "complete") {
        LightTableFilter.init();
      }
    });
  })(document);


   </script>


<?php
include_once 'user.footer.php'
?>
