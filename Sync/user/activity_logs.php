<?php
include_once 'user.header.php';
?>
<?php

if(($_SESSION['u_atype']=='admin')||($_SESSION['u_atype']=='manager')){

}else {
  header("Location: user.php?not_authorized");
}
?>
<!--Header-->
<div class="text-center bg-primary text-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="display-4">Logs</h1>
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
$sql = "SELECT * FROM Activity ";
$records = mysqli_query($conn, $sql);
?>

<div class="container">
  <div class="table-responsive">
    <div id="new-search-area"></div>
    <table id="user_dir" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="primary">
          <th scope="col">ID</th>
          <th scope="col">Previous Value</th>
          <th scope="col">Activity</th>
          <th scope="col">Username</th>
          <th scope="col">Timestamp</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($log = mysqli_fetch_assoc($records)) {
          echo "<tr class='clickable-row' data-href='url://'>";
          echo '<th scope="row">'.$log['logID']."</th>";
          echo  "<td>".$log['PreviousValue']."</td>";
          echo "<td>".$log['activity']."</td>";
          echo "<td>".$log['username']."</td>";
          echo "<td>".$log['incidentTime']."</td>";
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
