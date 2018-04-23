<?php
//including the database connection file
include_once 'user.header.php';
session_start();
$j_id = '31';
$username = $_SESSION['u_uid'];
$e_id = $_SESSION['e_id'];
$_SESSION["j_id"]=$j_id;
$user_description = $_SESSION['user_description'];
?>
<?php
if(isset($_POST['new_entry']))
{
  session_start();
  $j_id = $_SESSION['j_id'];

  $new_entry = "INSERT INTO JournalEntry (Date, JournalID, CreatedBy) VALUES ('0000-00-00','$j_id','$username')";
  $curr_entry = mysqli_query($conn, $new_entry);
  $e_id =  mysqli_insert_id($conn);
  //$new_entry = "INSERT INTO Transaction (JournalID, EntryID) VALUES ($j_id, $e_id)";
  //mysqli_query($conn, $new_entry);
  $_SESSION["e_id"]=$e_id;
  echo "Journal entry created successfully, current entry is #".$e_id;
}
$debits = 0;
$_SESSION["debits"]=$debits;
$credits = 0;
$_SESSION["credits"]=$credits;
?>

<?php
if(!isset($e_id)){
  $e_id = $_SESSION['e_id'];
  header("Location: journal.php?no_current_entry");
  exit();
}
?>

<?php
if(isset($_POST['save_data']))
{
  //session_start();
  $selected_date = mysqli_real_escape_string($conn, $_POST['datepicker']);
  $phpdate = strtotime( $selected_date );
  $from_date = date( 'Y-m-d', $phpdate );

  $user_description = mysqli_real_escape_string($conn, $_POST['user_description']);
  $_SESSION['user_description'] = $user_description;
  $e_id = $_SESSION['e_id'];
  $save_entry = "UPDATE JournalEntry SET Date = '$from_date', Description = '$user_description' WHERE EntryID = '$e_id'";
  $save_entry = mysqli_query($conn, $save_entry);
}
?>

<?php
if(isset($_POST['submit_for_approval']))
{
  session_start();
  $e_id = $_SESSION['e_id'];
  $selected_date = mysqli_real_escape_string($conn, $_POST['datepicker']);
  $phpdate = strtotime( $selected_date );
  $from_date = date( 'Y-m-d', $phpdate );

  $user_description = mysqli_real_escape_string($conn, $_POST['user_description']);
  $_SESSION['user_description'] = $user_description;
  $e_id = $_SESSION['e_id'];
  $save_entry = "UPDATE JournalEntry SET Date = '$from_date', Description = '$user_description' WHERE EntryID = '$e_id'";
  $save_entry = mysqli_query($conn, $save_entry);
  $submit_for_approval = "UPDATE JournalEntry SET Status = '1', Approved = 'pending' WHERE EntryID = '$e_id'";
  $submit_for_approval  = mysqli_query($conn, $submit_for_approval);
  header("Location: journal.php");
}
?>

<!--add all debits and credits-->
<?php
if(isset($_POST['submit_entry']))
{
  session_start();
  $j_id = $_SESSION['j_id'];
  $new_entry = "INSERT INTO JournalEntry (Date, JournalID, CreatedBy) VALUES ('0000-00-00','$j_id','$username')";
  $curr_entry = mysqli_query($conn, $new_entry);
  $e_id =  mysqli_insert_id($conn);
  //$new_entry = "INSERT INTO Transaction (JournalID, EntryID) VALUES ($j_id, $e_id)";
  //mysqli_query($conn, $new_entry);
  $_SESSION["e_id"]=$e_id;
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
  session_start();
  $e_id = $_SESSION['e_id'];
  $j_id = '31';

  $JournalName = mysqli_real_escape_string($conn, $_POST['JournalName']);
  $Amount = mysqli_real_escape_string($conn, $_POST['Amount']);
  $AccountName = mysqli_real_escape_string($conn, $_POST['AccountName']);
  $Side=$_POST['Side'];


  $prev_val = "Did not exist";
  $activity = "Adding journal";





  //updating the table
  $sql =  "INSERT INTO Transaction (Amount, Side, AccountName, EntryID, JournalID) VALUES ('$Amount', '$Side', '$AccountName', '$e_id', '$j_id')";
  $success = mysqli_query($conn, $sql);


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
    <div class="container">
    <h2>Entry #<?php echo "$e_id";?></h2>
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


  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-book"></i>
    Add a line</button>

  </nav>


  <?php
  include '../includes/dbh.inc.php';
  $sql = "SELECT * FROM Transaction WHERE JournalID = '$j_id' AND EntryID = '$e_id'";
  $curr_trans = mysqli_query($conn, $sql);
  ?>
  <div class="container">
    <div class="table-responsive">
      <div id="new-search-area"></div>
      <table id='journalize' class='table table-striped table-bordered' cellspacing='0' width='100%'>
        <thead>
          <tr class='primary'>
            <th scope='col'>Account</th>
            <th scope='col'>Debit</th>
            <th scope='col'>Credit</th>
            <th scope='col'>Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while( $row = mysqli_fetch_assoc($curr_trans) ) {
            ?>
            <tr class='clickable-row' data-href='url://'>
              <?php
              session_start();
              $debits=$_SESSION["debits"];
              $credits = $_SESSION["credits"];
              echo '<th>'.$row['AccountName'].'</td>';
              if ($row['Side']=='Debit'){
                echo "<td><p class='text-left'>".number_format($row['Amount'],2).'</td>';
                echo '<td> </td>';
                $debits += $row['Amount'];
              } else if($row['Side']=='Credit'){
                echo '<td> </td>';
                echo "<td><p class='text-right'>".number_format($row['Amount'],2).'</td>';
                $credits += $row['Amount'];
              } else {
                echo '<td> </td>';
                echo '<td> </td>';
              }
              echo "<td><a href=\"delete_transaction.php?id=$row[TransactionID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
              $_SESSION["debits"]=$debits;
              $_SESSION["credits"]=$credits;
              ?>


            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>





    <br><br><br>
    <?php
    include_once("../includes/dbh.inc.php");
    session_start();
    $debits=$_SESSION["debits"];
    $credits = $_SESSION["credits"];
    $e_id = $_SESSION['e_id'];
    $result = mysqli_query($conn, "SELECT * FROM `JournalEntry` WHERE `EntryID` = '$e_id' AND `AttachmentFile` != ''");

    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0){
      echo "<div class='alert alert-success' role='alert'>Your file has been successfully uploaded, select another file and select upload to overwrite.</div>";
    }


    ?>
    <div>
      <label for="form_control_upload_file">Supporting files</label>
      <form action ="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Upload</button>
      </form>
    </div>
    <br><br>
    <form class="form-group" action="journalize.php" method="POST">
      <p>Date: <input type="text" id="datepicker" value="<?php echo $selected_date;?>" name="datepicker"></p>


      <label for="user_description">Description</label>
      <textarea class="form-control" name="user_description" id="user_description" rows="3"><?php echo $user_description;?></textarea>
    </div>
    <div class="container">

      <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#submit_for_approval">
        Submit for approval
      </button> -->
      <?php include_once("../includes/dbh.inc.php");
      session_start();
      $debits=$_SESSION["debits"];
      $credits = $_SESSION["credits"];

      if ($debits==$credits){
        echo "<button type='submit_for_approval' name='submit_for_approval' class='btn btn-primary btn-lg'>Submit for Approval</button></div></form>";
      }else {
        echo "<div class='alert alert-danger' role='alert'>Sorry, your debits and credits must balance before submission.</div><button type='submit_for_approval' name='submit_for_approval' class='btn btn-primary disabled'>I consent</button></div>";
      }
      ?>


    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add a line</h5>
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




            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type='add_line' name='add_line' class='btn btn-primary btn-block'>Add line</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Verify for submit -->
    <!-- Modal -->
    <div class="modal fade" id="submit_for_approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to continue?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-group" action="journalize.php" method="POST">
            <div class="modal-body">
              I consent that all of the information that I entered is correct to the best of knowledge and my ability. I understand that intentional and or unethical modification of this submission form is punishable by law.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <?php include_once("../includes/dbh.inc.php");
              session_start();
              $debits=$_SESSION["debits"];
              $credits = $_SESSION["credits"];

              if ($debits==$credits){
                echo "<button type='submit_for_approval' name='submit_for_approval' class='btn btn-primary btn-block'>I consent</button></div></form>";
              }else {
                echo "<button type='submit_for_approval' name='submit_for_approval' class='btn btn-primary disabled'>I consent</button></div> <div class='alert alert-danger' role='alert'>Sorry, your debits and credits must balance before submission.</div>";
              }
              ?>

            </div>
          </div>
        </div>
      </div>


      <?php
      include_once 'user.footer.php';
      ?>
