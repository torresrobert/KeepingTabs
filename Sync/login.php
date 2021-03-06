<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="src/logo.png" />
  <link rel="icon" href="/src/logo.ico">
  <title>KeepingTabs</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="sign-in.css" type="text/css">

</head>

<body class="bg-dark">
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar3SupportedContent" aria-controls="navbar3SupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-center" id="navbar3SupportedContent">
        <a class="ml-3 btn navbar-btn btn-primary" href="index.php">Need an account?</a>
      </div>
    </div>
  </nav>
  <div class="py-5 filter-gradient">

    <div class="container mx-auto">
      <div class="col-sm-2"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6"></div>
          <div class="card text-black bg-light mx-auto">
            <div class="mx-auto py-2"><img class="mx-auto" src="src/logo_max_wide.png" style="width:275px;height:189px;"></div>
            <div class="card-body mx-auto">

              <h1>Welcome back to KeepingTabs</h1>
              <p>


                <!login form->
                <form class="login-form" action="includes/login.inc.php" method="POST">


                  <?php $url = "http://"
                 . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


if(strpos($url,'empty') !== false){ echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error 00 - </strong>
Fields are empty, please check input fields.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>'; } else if(strpos($url,'error_user_not_found') !== false){ echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error 00 - </strong>
Fields are empty, please check input fields.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>'; }
  else if(strpos($url,'error_password') !== false) { echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error 01 - </strong>
  Fields are empty, please check input fields.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>'; }
     else {
} ?>

                  <div class="form-group"> <label>Username</label>
                    <input type="username" name="username" class="form-control" placeholder="Enter Username"> </div>
                    <div class="form-group"> <label>Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password"> </div>
                      <button type="submit" name="submit" class="btn btn-secondary">Login</button>
                    </form>



                    <p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

          <div class="text-center bg-dark pt-5">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mt-3">
                  <p class="text-center text-muted">© Copyright 2018 KeepingTabs - All rights reserved. </p>
                </div>
              </div>
            </div>
          </div>
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <script src="js/smooth-scroll.js"></script>


        </body>

        </html>
