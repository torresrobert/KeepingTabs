<?php
include_once 'user.header.php';
?>


<div class="jumbotron">
  <h1 class="display-4">KeepingTabs Support</h1>
  <p class="lead">

    <?php
    if(($_SESSION['u_atype']=='admin')){
      echo "<div class='alert alert-success' role='alert'>
      You are currently view the support page for administrators. Still have questions? <a href='mailto:adminsupport@keepingtabs.co'>Contact KeepingTabs</a>
      </div>";
    } elseif(($_SESSION['u_atype']=='manager')){
      echo "<div class='alert alert-success' role='alert'>
      You are currently view the support page for managers if you feel this is incorrect please contact your administrator.
      </div>";

    }elseif(($_SESSION['u_atype']=='user')){
      echo "<div class='alert alert-success' role='alert'>
      You are currently view the support page for users if you feel this is incorrect please contact your immediate manager.
      </div>";

    }
    ?>
</div>



<!--User Support-->
<div class="container">
<h2>Getting Started</h2
      <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#G00" aria-expanded="true" aria-controls="G00">
          Do I need to register/verify my account?
        </button>
      </h5>
    </div>

    <div id="G00" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        Account verification at <strong>KeepingTabs</strong> is only required if you are considered an administrator.
        We currently do not require registration by any means outside of an administrator creating your credentials.
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#G01" aria-expanded="false" aria-controls="G01">
          What if I can't find an account?
        </button>
      </h5>
    </div>
    <div id="G01" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        If you have used the account in the past or you know that the account should exist, consider looking at your activity history under logs.
        <?php
        if(($_SESSION['u_atype']=='admin')){
          echo "<br><br> <div class='alert alert-warning' role='alert'>
        Recall that you are an administrator and may need to filter through the activity log.
        </div>";
        }
          ?> If you still cannot find the account you can search using the filtered search feature inside of chart of accounts. Here you can also see whether or not the account has been deactivated.  <?php  if(($_SESSION['u_atype']=='user')){
            echo "If you find you feel that a user is missing please contact your immediate manager.";
          }
          ?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          I need to contact someone.
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Finding users of the system is always simple but powerful using KeepingTabs. All users are able to search by username, first name,last name, and role. <?php  if(($_SESSION['u_atype']=='user')){
          echo "If you find you feel that a user is missing please contact your immediate manager.";
        }
        ?>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<br><br>
<?php
if(($_SESSION['u_atype']=='admin')){
  echo "
<!--Admin Support-->
<div class='container'>
<h2>Admin Support</h2
      <div id='accordion'>
  <div class='card'>
    <div class='card-header' id='headingOne'>
      <h5 class='mb-0'>
        <button class='btn btn-link' data-toggle='collapse' data-target='#AD00' aria-expanded='true' aria-controls='AD00'>
          How do I add new user?
        </button>
      </h5>
    </div>

    <div id='AD00' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion'>
      <div class='card-body'>
        Adding new accounts to <strong>KeepingTabs</strong> is simple. <br><br>Simply navigate to User Directory, select Add user, now fill out the form with the employees corresponding information. <br><br> <div class='alert alert-warning' role='alert'>
        Be sure to select an account type. Account types are a crucial role for maintaining the integrity of your system.
        </div>
    </div>
  </div>
  <div class='card'>
    <div class='card-header' id='headingTwo'>
      <h5 class='mb-0'>
        <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#AD01' aria-expanded='false' aria-controls='AD01'>
          How do I remove a user?
        </button>
      </h5>
    </div>
    <div id='AD01' class='collapse' aria-labelledby='headingTwo' data-parent='#accordion'>
      <div class='card-body'>
        If you would like to remove privileges from a user, this can be done by selecting a user under the User Directory and selecting Edit. <br><br>The account type should be set to disabled.<br><br> <div class='alert alert-warning' role='alert'>
        Be sure to select an account type. Account types are a crucial role for maintaining the integrity of your system.
        </div>
         If, infact, you would like to <strong>remove</strong> the user from KeepingTabs. <br><br> Navigate to the User Directory, find the user you would like to <strong>delete</strong> and select delete. You will be prompted to verification and the user will be removed.
      </div>
    </div>
  </div>
  <div class='card'>
    <div class='card-header' id='headingThree'>
      <h5 class='mb-0'>
        <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#AD02' aria-expanded='false' aria-controls='AD02'>
          How do I add a financial account?
        </button>
      </h5>
    </div>
    <div id='AD02' class='collapse' aria-labelledby='headingThree' data-parent='#accordion'>
      <div class='card-body'>
        Adding financial accounts is not something that often required using KeepingTabs. You are able to keep reusing the currently active financial accounts. <br><br>

        <div class='alert alert-warning' role='alert'>
        Recall that accounts can be disable and reenabled if business needs require. <strong>Admin access is required.</strong>
        </div>
        To add a new financial account navigate to <strong>Chart of Accounts</strong>, search for the existing account and make sure it does not exist, select the <strong>Add new account</strong> button, fill out the corresponding financal account information and select the <strong>Create Account</strong> button. You have now added a new financial account.

      </div>
    </div>
  </div>
</div>
</div>
</div>
<br><br><br><br>

";
}
?>




<?php
include_once 'user.footer.php';
?>
