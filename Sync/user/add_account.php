<?php
//including the database connection file
include_once 'user.header.php';
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
  <form class="p-4 section-light bg-light" class="signup-form" action="add_user.php" method="POST">


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
                <label class="input-group-text"  for="inputGroupSelect01">Account Type</label>
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
<div>
        <?php

        include_once 'user.footer.php';
        ?>
