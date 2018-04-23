<?php
include_once 'user.header.php';
$filter = "pending";
$_SESSION["filter"]=$filter;
?>

<?php
if(isset($_POST['submit'])&&(($_SESSION['u_atype']=='admin')||($_SESSION['u_atype']=='manager')))
{
  $username = $_SESSION['u_uid'];

  $JournalName = mysqli_real_escape_string($conn, $_POST['JournalName']);

  $prev_val = "Did not exist";
  $activity = "Adding journal";

  // checking empty fields
  if (empty($JournalName))
  {
    echo "<font color='red'>Journal name is empty.</font><br/>";

  }else{
      $sql_check = "SELECT * FROM Journal WHERE JournalName = '$JournalName'";
      $result = mysqli_query($conn, $sql_check);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck > 0){
        echo "<font color='red'>Journal name is already taken.</font><br/>";
        echo "<button class='btn btn-outline-danger' onclick='window.history.go(-1)'>Try again?</button>";
        }


    else{
      //updating the table
      $sql =  "INSERT INTO Journal (JournalName) VALUES ('$JournalName')";
      $success = mysqli_query($conn, $sql);

      $log = "INSERT INTO Activity (PreviousValue, activity, username) VALUES ('$prev_val','$activity', '$username');";
      mysqli_query($conn, $log);

      if ($success) {
        echo "Journal added successfully";
      } else {
        echo "Error: " . mysqli_error($conn);
      }

    }


  }
}
?>

<?php
if(isset($_POST['filter']))
{

  if(isset($_POST['pending'])){
  $_SESSION["filter"] = "pending";
}else if(isset($_POST['approved'])){
  $_SESSION["filter"] = "approved";
}else if(isset($_POST['denied'])){
  $_SESSION["filter"] = "denied";
}

    }
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Journals</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="text-white" target="_blank">Missing something? You can request a new account here.</a>
        </div>
      </div>
    </div>
  </div>
<!--add new Journal Entry-->
  <nav class="navbar navbar-light bg-light">

<form action="journalize.php" method="POST">
  <button class="btn btn-primary" type='new_entry' name='new_entry'><i class="fas fa-book"></i>  Add new journal entry</button>
</form>

  <div class="dropdown show">
  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Assessment
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">Pending</a>
    <a class="dropdown-item" href="#">Approved</a>
    <a class="dropdown-item" href="#">Rejected</a>
  </div>

</div>


</nav>
<!--display table-->
<?php
include '../includes/dbh.inc.php';
$sql = "SELECT * FROM Journal";
$records = mysqli_query($conn, $sql);
?>

<div class="container">
<?php
$filter = $_SESSION["filter"];
while ($curr_journal = mysqli_fetch_assoc($records)){
  $JournalName = $curr_journal["JournalName"];
  $JournalID = $curr_journal["JournalID"];
echo "<div class='container'>";
  echo "<h1>" . $curr_journal["JournalName"] . "</h1>";
echo "</div>";

  echo "<div class='table-responsive'>
    <div id='new-search-area'></div>
    <table id='journal' class='table table-striped table-bordered' cellspacing='0' width='100%'>
      <thead>
        <tr class='primary'>
          <th scope='col'>Entry ID</th>
          <th scope='col'>Submission Date</th>
          <th scope='col'>Description</th>
          <th scope='col'>Approved</th>
          <th scope='col'>Journal ID</th>";
          if (($_SESSION['u_atype']=='manager')){
            echo "<th scope='col'>Assessment</th>";
          }

      echo "</tr>
      </thead>
      <tbody>";
      $query = "SELECT * FROM JournalEntry WHERE JournalID = $JournalID AND Status = 1";
      $entries = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($entries)) {
        echo "<tr class='clickable-row' data-href='url://'>";
        echo "<th scope='row'><a href='view_entry.php?id=$row[EntryID]'>".$row['EntryID']."</a></th>";
        echo  "<td>".$row['Date']."</td>";
        echo "<td>".$row['Description']."</td>";
        if ($row['Approved'] == "approved"){
          echo "<td>Yes</td>";
        }else if($row['Approved'] == "denied"){
          echo "<td>No</td>";
        }else if($row['Approved'] == "pending"){
          echo "<td>Pending</td>";
        }

        echo "<td>".$row['JournalID']."</td>";
        if (($_SESSION['u_atype']=='manager')&&($row['Approved'] == "pending")){
          echo "<td data-toggle='modal' data-id='$row[EntryID]' data-target='#orderModal'><a href=\"approve_journal_entry.php?id=$row[EntryID]\" class='btn btn-success' role='button'>Approve</a>
          <a href=#' data-target='#my_modal' data-toggle='modal' class='btn btn-danger' role='button' data-id='my_id_value'>Deny</a></td>";
}else if (($_SESSION['u_atype']=='manager')&&($row['Approved'] != "pending")){
  echo "<td> </td>";
}
        echo "</tr>";
      }

      echo "
      </tbody>
    </table>
  </div>
</div>
"
;
}
?>
</div>
<!--
<div class="modal fade" id="exampleModal" tabindex="-1" role="orderModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Would you like to deny entry ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-group" action="deny_journal_entry.php" method="POST">
      <div class="modal-body">
      <label for="reason">Reason for Assessment</label>
      <textarea class="form-control" name="user_description" id="reason" rows="3"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type='deny_journal_entry' name='deny_journal_entry' class='btn btn-danger'>Deny the entry</button></div></form>
      </div>
    </div>
  </div>
</div> -->

<a href="#" data-target="#my_modal" data-toggle="modal" class="identifyingClass" data-id="my_id_value">Open Modal</a>

<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
<div class="modal-dialog" role="dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal Title</h4>
        </div>
        <div class="modal-body">
            Modal Body
            <input type="hidden" name="hiddenValue" id="hiddenValue" value="" />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary">Yes</button>
        </div>
    </div>
</div>
</div>

<?php
include_once 'user.footer.php';
?>
