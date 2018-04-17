<?php
include_once 'user.header.php';
?>
<div class="jumbotron">
  <h1 class="display-4">Welcome back, <?php $firstName = $_SESSION['u_first']; echo $firstName; ?>!</h1>
  <p class="lead">
  <div class="alert alert-success" role="alert">
  There are currently no pending requests. Please feel free to explore all of the system functions.
</div></p>
  <hr class="my-4">
  <p>If something is unclear please feel free to explore the documentation section.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="documentation.php" role="button">Learn more</a>
  </p>
</div>

<!--Charts--->

<div class="container">
  <div class="row">
    <div class="col">
      <canvas id="myChart1" width="400" height="400"></canvas>
      <div class="text-center"><h2><strong>Credits</strong></h2>
      </div>
    </div>
<div class="col">
</div>

    <div class="col">
<canvas id="expensesBar" width="400" height="400"></canvas>

<div class="text-center"><h2><strong>Expenses</strong></h2>
</div>
</div>

</div>
</div>
<!--Charts--->




<?php
include_once 'user.footer.php';
?>
