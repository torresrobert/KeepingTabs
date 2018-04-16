<?php
//including the database connection file
include_once 'user.header.php';

session_start();
  include '../includes/dbh.inc.php';
$e_id = $_GET['id'];

$sql = "SELECT * FROM FinancialAccounts WHERE AccountID = '$AccoutNumber'";
$records = mysqli_query($conn, $sql);
$curr_account = mysqli_fetch_row($records);
$AccountName = $curr_account[1];
?><div class="bg-info">
<div class="text-center bg-primary text-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="display-5 text-white"><strong>View Entry</strong></h1>
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

<?php
//getting id from url

//

//selecting data associated with this particular id
$entry = mysqli_query($conn, "SELECT * FROM JournalEntry WHERE EntryID = '$e_id'");
$all_trans = mysqli_query($conn, "SELECT * FROM Transaction WHERE EntryID = '$e_id'");


while($curr_entry = mysqli_fetch_array($entry))
{
    $date = $curr_entry['Date'];
    $user_description = $curr_entry['Description'];
    $attache =  $curr_entry['AttachmentFile'];
    $isApproved = $curr_entry['isApproved'];
    $CreatedBy = $curr_entry['CreatedBy'];
    $JournalID = $curr_entry['JournalID'];
}
while($curr_trans = mysqli_fetch_array($all_trans))
{
    $TransactionID = $curr_trans['TransactionID'];
    $Amount = $curr_trans['Amount'];
    $Side = $curr_trans['Side'];
    $AccountName = $curr_trans['AccountName'];
}
?>

<nav class="navbar navbar-light bg-light">
  <a class="btn btn-outline-primary span4" href="journal.php" role="button"><i class="	fa fa-chevron-left"></i> Journal</a>'

</nav>
<div class="container bg-info">
        <!--update accounts form-->
        <div class="text-center bg-info text-white py-5">
          <form class="card mx-auto" class="form-control" action="edit_account.php" method="POST">

            <div class="card-header text-bolder" >
              Recall that changes cannot be made after submission.
            </div>
          <div class="card-body">

          <div class="form-group"> <label for="accountNumber">Date</label>
            <input type="text" class="form-control" disabled="disabled" name="date" value="<?php echo $date;?>" id="accountNumber"> </div>

            <div class="form-group"> <label for="accountNumber">Attached Files</label>
            <div class="alert alert-info" role="alert">
  <a href="/user/<?php echo $attache; ?>" class="alert-link">Click to open</a>
</div>

            <div class="form-group"> <label for="accountName">Description</label>
              <textarea class="form-control disabled" disabled="disabled" name="user_description" id="user_description" rows="3"><?php echo $user_description;?></textarea></div>

              <?php
              include '../includes/dbh.inc.php';
              $sql = "SELECT * FROM Transaction WHERE EntryID = '$e_id'";
              $curr_trans = mysqli_query($conn, $sql);
              ?>
              <div class="table-responsive">
                <div id="new-search-area"></div>
                <table id='journalize' class='table table-striped table-bordered' cellspacing='0' width='100%'>
                  <thead>
                    <tr class='primary'>
                      <th scope='col'>Account</th>
                      <th scope='col'>Debit</th>
                      <th scope='col'>Credit</th>
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
                        ?>


                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
                </form>


              </div>
            </div>
          </div>
        </div>
<?php

include_once 'user.footer.php';
?>
