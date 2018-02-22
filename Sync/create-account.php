<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>KeepingTabs - Create Account</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="theme.css" type="text/css">
  <!-- Script: Make my navbar transparent when the document is scrolled to top -->
  <script src="js/navbar-ontop.js"></script>
  <!-- Script: Animated entrance -->
  <script src="js/animate-in.js"></script>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md bg-primary navbar-light fixed-top">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar3SupportedContent" aria-controls="navbar3SupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-center" id="navbar3SupportedContent">
        <a class="btn navbar-btn btn-secondary mx-2" href="index.php">Learn more</a>
      </div>
    </div>
  </nav>
  <!-- Cover -->
  <div class="align-items-center d-flex py-5 cover section-primary" style="background-image: url(&quot;assets/restaurant/cover_light.jpg&quot;);">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 align-self-center text-lg-left text-center">
          <h1 class="mb-0 mt-4 display-4">Create your account</h1>
        </div>
        <div class="col-lg-5 p-3">

          <!--signup form-->
          <form class="p-4 section-light bg-light" class="signup-form" action="includes/signup.inc.php" method="POST">
            <h4 class="mb-3 text-center">Join now</h4>


            <div class="form-group"> <label for="firstName">First Name</label>
              <input type="text" class="form-control" name="firstName" id="firstName" placeholder="John"> </div>

              <div class="form-group"> <label for="lastName">Last Name</label>
                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Doe"> </div>

                <div class="form-group"> <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter username"> <small id="emailHelp" class="form-text"></small> </div>

                  <div class="form-group"> <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"> </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
                  </form>


                </div>
              </div>
            </div>
          </div>

          <?php
          include_once 'footer.php';
          ?>
