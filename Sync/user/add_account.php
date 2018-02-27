<?php
//including the database connection file
include_once 'user.header.php';
?>
<?php
//header();
if(isset($_POST['submit'])&&($_SESSION['u_atype']=='admin'))
{
  $accountNumber = mysqli_real_escape_string($conn, $_POST['accountNumber']);
  $accountName = mysqli_real_escape_string($conn, $_POST['accountName']);
  $accountType=$_POST['accountType'];
  $isActive=$_POST['isActive'];
  $NormalSide=$_POST['NormalSide'];
  $Balance = mysqli_real_escape_string($conn, $_POST['Balance']);



      //check if username is taken
      $sql = "SELECT * FROM FinancialAccounts WHERE accountNumber='$accountNumber'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck > 0){

        exit();
      }else{
        //header("Location: add_user.php?created-successful");
        //hashing the password

        //insert user into database
        $sql = "INSERT INTO FinancialAccounts (accountNumber, accountName, accountType, isActive, NormalSide, Balance, AccountID) VALUES ('$accountNumber', '$accountName', '$accountType', '$isActive', '$NormalSide', '$Balance','$accountNumber');";
        mysqli_query($conn, $sql);


        //header("Location: add_user.php?created-successful");
        //  header("Location: user_dir.php?sign-up=usertaken");
        if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Account added successfully";
        }
      }
}
?>
<div class="text-center bg-primary text-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="display-5 text-white"><strong>Adding New Financial Account</strong></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="text-white" target="_blank">Missing something? You can submit a new ticket here.</a>
      </div>
    </div>
  </div>
</div>

<div class="text-center bg-info text-white py-5">
  <div class="container">





    <!--signup form-->
    <form class="p-4 section-light bg-light" class="signup-form" action="add_account.php" method="POST">


      <div class="form-group"> <label for="accountNumber">Account Number</label>
        <input type="text" class="form-control" name="accountNumber" id="accountNumber" placeholder="account number"> </div>

        <div class="form-group"> <label for="accountName">Account Name</label>
          <input type="text" class="form-control" name="accountName" id="accountName" placeholder="account name"> </div>

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
                <input type="number" class="form-control" name="Balance" id="Balance" placeholder="$0.00"> </div>

              <button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
            </form>


          </div>
        </div>

            <?php

            include_once 'user.footer.php';
            ?>
