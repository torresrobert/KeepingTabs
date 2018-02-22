<?php
include_once 'user.header.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

<!--Header-->
<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">User Directory</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="text-white" target="_blank">Missing something? You can submit a new ticket here.</a>
        </div>
      </div>
    </div>
  </div>

<!--Search user directory-->
<nav class="navbar navbar-light bg-light">
  <?php
  if (($_SESSION['u_atype']=='admin')){
  echo '<a class="btn btn-primary btn span4" href="add_user.php" role="button">Add user</a>';
 }
 ?>



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


<!--Table of users-->
<?php
include '../includes/dbh.inc.php';
$sql = "SELECT * FROM Users WHERE isActive = '1'";
$records = mysqli_query($conn, $sql);
?>

<div class="container" style="text-align:center">
   <table id="user_dir" class="order-table table-responsive table table-hover">
 <thead>
   <tr class="primary">
     <th scope="col">Username</th>
     <th scope="col">First</th>
     <th scope="col">Last</th>
     <th scope="col">Role</th>
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
     echo '<th scope="row">'.$employee['username']."</th>";
     echo  "<td>".$employee['firstName']."</td>";
     echo "<td>".$employee['lastName']."</td>";
     echo "<td>".$employee['accountType']."</td>";
     if (($_SESSION['u_atype']=='admin')){
     echo "<td><a href=\"edit_user.php?id=$employee[username]\">Edit</a> | <a href=\"delete_user.php?id=$employee[username]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
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
include_once 'user.footer.php';
?>
