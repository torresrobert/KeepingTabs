<?php
//including the database connection file
include_once 'user.header.php';
$sql =  "SELECT MAX(EntryID) FROM JournalEntry;";
$curr_EntryID = mysqli_query($conn, $sql);
$curr_EntryID++;
//echo $curr_EntryID;
?>

<?php
if(isset($_POST['submit']))
{
  $username = $_SESSION['u_uid'];


  $JournalName = mysqli_real_escape_string($conn, $_POST['JournalName']);
  $Amount = mysqli_real_escape_string($conn, $_POST['Amount']);
  $AccountName = mysqli_real_escape_string($conn, $_POST['AccountName']);
  $Side=$_POST['Side'];


  $prev_val = "Did not exist";
  $activity = "Adding journal";

  $curr_JournalID = 31;



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
      $sql =  "INSERT INTO Transaction (Amount, Side, AccountName, Current) VALUES ('$Amount', '$Side', '$AccountName', '1')";
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
  $sql = "SELECT * FROM Journal";
  $records = mysqli_query($conn, $sql);
  ?>

  <div class="container">
  <?php
  while ($curr_journal = mysqli_fetch_assoc($records)){
    $JournalName = $curr_journal["JournalName"];
    $JournalID = $curr_journal["JournalID"];
  echo "<div class='container'>";
    echo "<h1> Journal " . $curr_journal["EntryID"] . "</h1>";
    echo "<div class='table-responsive'>
      <div id='new-search-area'></div>
      <table id='journal' class='table table-striped table-bordered' cellspacing='0' width='100%'>
        <thead>
          <tr class='primary'>
            <th scope='col'>Account</th>
            <th scope='col'>Debit</th>
            <th scope='col'>Credit</th>
            <th scope='col'>Delete</th>
          </tr>
        </thead>
        <tbody>";
        $query = "SELECT * FROM Transaction WHERE Current = '1'";
        $entries = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($entries)) {
          echo "<tr class='clickable-row' data-href='url://'>";
          echo '<th scope="row">'.$row['AccountName']."</th>";
          if ($row['Side']=='Debit'){
            echo "<td><p class='text-right'>$".number_format($row['Amount'],2)."</p></td>";
            echo "<td> </td>";
          }else if ($row['Side']=='Credit'){
            echo "<td> </td>";
            echo "<td><p class='text-right'>$".number_format($row['Amount'],2)."</p></td>";
          }

          echo "<td><a href=\"delete_transaction.php?id=$employee[username]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
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

<br><br><br>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="button" href="#" class="btn btn-primary btn-lg">Submit</button>

</div>


        <?php
        include_once 'user.footer.php';
        ?>
