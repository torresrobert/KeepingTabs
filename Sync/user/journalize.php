<?php
//including the database connection file
include_once 'user.header.php';

?>
<?php
if(isset($_POST['new_entry']))
{

$j_id = $_GET['id'];
$username = $_SESSION['u_uid'];
$new_entry = "INSERT INTO JournalEntry (Date, JournalID, CreatedBy) VALUES ('0000-00-00','$j_id','$username')";
$curr_entry = mysqli_query($conn, $new_entry);
$e_id =  mysqli_insert_id($conn);
$new_entry = "INSERT INTO Transaction (JournalID, EntryID) VALUES ($j_id, $e_id)";
mysqli_query($conn, $new_entry);
echo "Journal entry created successfully, current entry is #".$e_id;
}
?>

<!--scan for all active financial accounts-->
<?php
$get = mysqli_query($conn, "SELECT accountName FROM FinancialAccounts ORDER BY accountNumber ASC");
$option = '';
 while($an = mysqli_fetch_assoc($get))
{

  $option .= '<option value = "'.$an['accountName'].'">'.$an['accountName'].'</option>';
}
 ?>

 <!--add a line-->
<?php
if(isset($_POST['add_line']))
{

  $JournalName = mysqli_real_escape_string($conn, $_POST['JournalName']);
  $Amount = mysqli_real_escape_string($conn, $_POST['Amount']);
  $AccountName = mysqli_real_escape_string($conn, $_POST['AccountName']);
  $Side=$_POST['Side'];


  $prev_val = "Did not exist";
  $activity = "Adding journal";



  // checking empty fields
  /*if (empty($JournalName))
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


    else{*/
      //updating the table
      $sql =  "INSERT INTO Transaction (Amount, Side, AccountName, EntryID, JournalID) VALUES ('$Amount', '$Side', '$AccountName', '$e_id', '$j_id')";
      $success = mysqli_query($conn, $sql);

      /*$log = "INSERT INTO Activity (PreviousValue, activity, username) VALUES ('$prev_val','$activity', '$username');";
      mysqli_query($conn, $log);*/

      if ($success) {
        echo "Line added successfully";
      } else {
        echo "Error: " . mysqli_error($conn);
      }

    }

?>

<!--Header-->
<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5 text-white"><strong>Journalize</strong></h1>
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

  <a class="btn btn-outline-primary span4" href="journal.php" role="button"> <i class="	fa fa-chevron-left"></i> Journals</a>

  <?php
  if (($_SESSION['u_atype']=='admin')||($_SESSION['u_atype']=='manager')){


    $formioli = "
    <form class='signup-form' action='journalize.php' method='POST'>
      <div class='form-group'> <label for='AccountName'>Name</label>
        <input type='text' class='form-control' id='AccountName' name='AccountName'  placeholder='Enter an a name'>
      </div>
      <div class='form-group'> <label for='Amount'>Amount</label>
        <input type='text' class='form-control' id='Amount' name='Amount'  placeholder='Enter an amount'>
      </div>
      <br>
      <div class='input-group mb-3'>
        <div class='input-group-prepend'>
          <label class='input-group-text'  for='inputGroupSelect01'>Side</label>
        </div>
              <select class='custom-select' name='Side' id='inputGroupSelect01'>
                <option selected>Choose...</option>
                <option value='Debit'>Debit</option>
                <option value='Credit'>Credit</option>
              </select>
      </div>


      <button type='submit' name='submit' class='btn btn-primary btn-block'>Add line</button>
  </form>
    ";


  echo '<a class="btn btn-primary btn span4" href="#" name="toggle" data-toggle="popover" data-html="true" title="Add new line" data-content="' . $formioli . '"><i class="fas fa-book"></i>  Add new line</a>';
  }
  ?>
  </nav>

  <?php
  include '../includes/dbh.inc.php';
  $sql = "SELECT * FROM Transaction WHERE JournalID = '$j_id' AND EntryID = '$e_id'";
  $curr_trans = mysqli_query($conn, $sql);
  ?>
  <div class="container">
    <div class="table-responsive">
      <div id="new-search-area"></div>
  <table id='journal' class='table table-striped table-bordered' cellspacing='0' width='100%'>
    <thead>
      <tr class='primary'>
        <th scope='col'>Transaction ID</th>
        <th scope='col'>Account</th>
        <th scope='col'>Debit</th>
        <th scope='col'>Credit</th>
        <th scope='col'>Modify</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while( $row = mysqli_fetch_assoc($curr_trans) ) {
      ?>
      <tr class='clickable-row' data-href='url://'>
          <?php echo '<th scope="row">'.$row['TransactionID'].'</th>';
           echo '<td>'.$row['AccountName'].'</td>';
           if ($row['Side']=='Debit'){
          echo '<td>'.$row['Amount'].'</td>';
           echo '<td> </td>';
         } else if($row['Side']=='Credit'){
           echo '<td> </td>';
            echo '<td>'.$row['Amount'].'</td>';
         } else {
           echo '<td> </td>';
           echo '<td> </td>';
         }
           echo "<td><a href=\"edit_curr_trans.php?id=$row[TransactionID]\">Edit</a> | <a href=\"delete_account.php?id=$row[TransactionID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
           ?>
</tr>


<?php
}
?>
</tbody>
</table>
</div>





  <br><br><br>
<div>
  <label for="form_control_upload_file">Supporting files</label>
  <form action ="upload.php" method="POST" enctype="multipart/form-data">
      	<input type="file" name="file">
      	<button type="submit" name="submit">Upload</button>
      </form>
</div>
<br><br>

<p>Date: <input type="text" id="datepicker"></p>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="button" href="#" class="btn btn-primary btn-lg">Submit</button>

</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class='signup-form' action='journalize.php' method='POST'>
          <div class='form-group'> <label for='AccountName'>Name</label>
            <select class='custom-select' name='AccountName' id='AccountName'>
                    <?php echo $option; ?>
          </select>
          </div>
          <div class='form-group'> <label for='Amount'>Amount</label>
            <input type='text' class='form-control' id='Amount' name='Amount'  placeholder='Enter an amount'>
          </div>
          <br>
          <div class='input-group mb-3'>
            <div class='input-group-prepend'>
              <label class='input-group-text'  for='inputGroupSelect01'>Side</label>
            </div>
                  <select class='custom-select' name='Side' id='inputGroupSelect01'>
                    <option selected>Choose...</option>
                    <option value='Debit'>Debit</option>
                    <option value='Credit'>Credit</option>
                  </select>
          </div>


          <button type='add_line' name='add_line' class='btn btn-primary btn-block'>Add line</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php
include_once 'user.footer.php';
?>
