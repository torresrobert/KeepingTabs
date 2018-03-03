<?php
include_once 'user.header.php';
?>


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
    echo '<a class="btn btn-primary span4" href="add_user.php" role="button">Add user</a>';
  }
  ?>

</nav>


<!--Table of users-->
<?php
include '../includes/dbh.inc.php';
$sql = "SELECT * FROM Users WHERE isActive = '1'";
$records = mysqli_query($conn, $sql);
?>

<div class="container">
  <div class="table-responsive">
    <div id="new-search-area"></div>
    <table id="user_dir" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
</div>




<?php
include_once 'user.footer.php';
?>
