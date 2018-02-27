<?php
//including the database connection file
include_once 'user.header.php';
?>
<?php
//header();
if(isset($_POST['submit'])&&($_SESSION['u_atype']=='admin'))
{
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
  $accountType=$_POST['accountType'];

  // checking empty fields
  if (empty($username) || empty($password) || empty($firstName) || empty($lastName)) {
    header("Location: user_dir.php");
    exit();

  }else{
    //check if input characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $firstName)||!preg_match("/^[a-zA-Z]*$/", $lastName)){
      header("Location: user_dir.php?signup=invalid");
      exit();
    }else{
      //check if username is taken
      $sql = "SELECT * FROM Users WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck > 0){
        header("Location: user_dir.php?sign-up=usertaken");
        exit();
      }else{
        //header("Location: add_user.php?created-successful");
        //hashing the password
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        //insert user into database
        $sql = "INSERT INTO Users (username, password, firstName, lastName, accountType) VALUES ('$username', '$hashedPwd', '$firstName', '$lastName', '$accountType');";
        $log = "INSERT INTO Activity (username, password, firstName, lastName, accountType) VALUES ('$username', '$hashedPwd', '$firstName', '$lastName', '$accountType');";
        mysqli_query($conn, $sql);
        //header("Location: add_user.php?created-successful");

      }  if (($result = $conn->query($sql)) !== FALSE){
        echo "success";
      }

    }
  }

}
?>

<div class="text-center bg-primary text-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="display-5 text-white"><strong>Adding New User</strong></h1>
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
  <form class="card mx-auto" style="width: 22rem;" class="signup-form" action="add_user.php" method="POST">

<div class="card-body">
    <div class="form-group"> <label for="firstName">First Name</label>
      <input type="text" class="form-control" name="firstName" id="firstName" placeholder="first name"> </div>

      <div class="form-group"> <label for="lastName">Last Name</label>
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="last name"> </div>

        <div class="form-group"> <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="username"> <small id="username" class="form-text"></small> </div>

          <div class="form-group"> <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="password"> </div>


            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <lÍÍÍÍÍÍabel class="input-group-text"  for="inputGroupSelect01">Account Type</label>
              </div>
              <select class="custom-select" name="accountType" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="user">User</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
              </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
          </form>

</div>
        </div>
      </div>

        <?php

        include_once 'user.footer.php';
        ?>
