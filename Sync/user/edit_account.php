<?php
include_once 'user.header.php';
$AccountID = $_GET['id'];
?>
<?php
if(isset($_POST['update'])&&($_SESSION['u_atype']=='admin'))
{
    $AccountID = $_REQUEST['AccountID'];
    $accountName = mysqli_real_escape_string($conn, $_POST['accountName']);
    $accountType=$_POST['accountType'];
    $isActive=$_POST['isActive'];
    $NormalSide=$_POST['NormalSide'];
    $Balance = mysqli_real_escape_string($conn, $_POST['Balance']);
    $accountNumber = mysqli_real_escape_string($conn, $_POST['accountNumber']);

    // checking empty fields
    if(empty($accountName) || empty($Balance)){
        if(empty($accountName)) {
            echo "<font color='red'>Account name field is empty.</font><br/>";

            echo "<button class='btn btn-outline-danger' onclick='goBack()'>Try again?</button>";


        }

        if(empty($Balance)) {
            echo "<font color='red'>Account balance field is empty.</font><br/>";

            echo "<button class='btn btn-outline-danger' onclick='goBack()'>Try again?</button>";
        }

      }else{
        //updating the table
        $sql = "UPDATE FinancialAccounts SET accountName = '$accountName', accountType = '$accountType', NormalSide = '$NormalSide', Balance = '$Balance', isActive = '$isActive' WHERE accountNumber = '$accountNumber'";
        $update = mysqli_query($conn, $sql);


}
        //header("Location: user_dir.php");
        if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }


    }



?>
<div class="text-center bg-warning text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5 text-danger"><strong>Modifying Account Information</strong></h1>
        </div>
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
$result = mysqli_query($conn, "SELECT * FROM FinancialAccounts WHERE AccountID = '$AccountID'");



while($employee = mysqli_fetch_array($result))
{
    $accountNumber = $employee['accountNumber'];
    $accountName = $employee['accountName'];
    $accountType = $employee['accountType'];
    $isActive = $employee['isActive'];
    $NormalSide = $employee['NormalSide'];
    $Balance = $employee['Balance'];
}
?>



        <!--update accounts form-->
        <form class="p-4 section-light bg-light" class="form-control" action="edit_account.php" method="POST">


          <div class="form-group"> <label for="accountNumber">Account Number</label>
            <input type="text" class="form-control" name="accountNumber" value="<?php echo $accountNumber;?>" id="accountNumber"> </div>

            <div class="form-group"> <label for="accountName">Account Name</label>
              <input type="text" class="form-control" name="accountName" value="<?php echo $accountName;?>"></div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text"  for="inputGroupSelect01">Account Type</label>
                </div>
                <select class="custom-select" name="accountType" id="inputGroupSelect01">

                  <option selected>Choose...</option>
                  <option value="assets">Assets</option>
                  <option value="liabilities">Liabilities</option>
                  <option value="owners_equity">Owners Equity</option>
                  <option value="revenue">Revenue</option>
                  <option value="expenses">Expenses</option>
                </select>
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text"  for="inputGroupSelect02">Is Active?</label>
                </div>

                <select class="custom-select" name="isActive" id="inputGroupSelect02">
                  <option selected>Choose...</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>


                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text"  for="inputGroupSelect03">Normal Side</label>
                    </div>

                    <select class="custom-select" name="NormalSide" id="inputGroupSelect03">
                      <option selected>Choose...</option>
                      <option value="credit">Credit</option>
                      <option value="debit">Debit</option>
                    </select>
                  </div>

                  <div class="form-group"> <label for="Balanace">Balance</label>
                    <input type="number" class="form-control" name="Balance" value="<?php echo $Balance;?>" placeholder="$0.00"> </div>

                  <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
                </form>


              </div>
            </div>

<script>
function goBack() {
    window.history.back();
}
</script>
<?php
include_once 'user.footer.php';
?>
