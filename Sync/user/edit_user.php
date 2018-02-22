<?php
include_once 'user.header.php';
$username = $_GET['id'];
?>
<?php
if(isset($_POST['update'])&&($_SESSION['u_atype']=='admin'))
{
    $username = $_REQUEST['username'];

    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
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
<div class="card mx-auto" style="width: 22rem;">
  <div class="card-header text-bolder" >
    Changes to the information below will be proccessed immediately.
  </div>
  <div class="card-body">

    <form name="form1" method="POST" action="edit_user.php">
        <table>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="firstName" value="<?php echo $firstName;?>"></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="lastName" value="<?php echo $lastName;?>"></td>
            </tr>
            <tr>
                <td>Account Type</td>
                <td><input type="text" name="accountType" value="<?php echo $accountType;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="username" value=<?php echo $username;?>></td>
                <td><input type="submit" class="btn btn-primary" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
  </div>
  </div>
</div>





<?php
include_once 'user.footer.php';

?>
