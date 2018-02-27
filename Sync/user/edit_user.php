<?php
include_once 'user.header.php';
$username = $_GET['id'];
?>
<?php
if(isset($_POST['update'])&&($_SESSION['u_atype']=='admin'))
{
    $username = $_REQUEST['username'];


    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $accountType=$_POST['accountType'];

    // checking empty fields
    if(empty($firstName) || empty($lastName) || empty($accountType)) {
        if(empty($firstName)) {
            echo "<font color='red'>First name field is empty.</font><br/>";
        }

        if(empty($lastName)) {
            echo "<font color='red'>Last name field is empty.</font><br/>";
        }

        if(empty($accountType)) {
            echo "<font color='red'>Account type field is empty.</font><br/>";
        }
    } else {
        //updating the table
        $sql =  "UPDATE Users SET firstName='$firstName',lastName='$lastName',accountType='$accountType' WHERE username='$username'";
        $update = mysqli_query($conn, $sql);

        //redirectig to the display page. In our case, it is index.php
        //header("Location: user_dir.php");
    }
    if ($conn->query($sql) == TRUE) {
    echo "Record updated successfully";
} else {
    echo "Record added successfully";
}

}
?>
<div class="text-center bg-warning text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5 text-danger"><strong>Modifying User Information</strong></h1>
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

//$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM Users WHERE username = '$username'");



while($employee = mysqli_fetch_array($result))
{
    $firstName = $employee['firstName'];
    $lastName = $employee['lastName'];
    $accountType = $employee['accountType'];
}
?>
<div class="text-center bg-info text-white py-5">
  <form class="card mx-auto" style="width: 22rem;" class="update-form" action="edit_user.php" method="POST">
    <div class="card-header text-bolder" >
      Changes to the information below will be proccessed immediately.
    </div>
  <div class="card-body">
    <div class="form-group"> <label for="firstName">First Name</label>
      <input type="text" class="form-control" name="firstName" value="<?php echo $firstName;?>"  placeholder="first name"> </div>

      <div class="form-group"> <label for="lastName">Last Name</label>
        <input type="text" class="form-control" name="lastName" value="<?php echo $lastName;?>" placeholder="last name"> </div>

        <div class="form-group"> <label for="username">Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo $username;?>" placeholder="username"> <small id="username" class="form-text"></small> </div>

            <div class="card-header text-bolder" >
              If no account type is selected, the default option will be selected.
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text"  for="inputGroupSelect01">Account Type</label>
              </div>
              <select class="custom-select" name="accountType" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="user">User</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
              </select>
            </div>

            <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
          </form>
</div>



<?php
include_once 'user.footer.php';

?>
