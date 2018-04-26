<?php
include_once 'user.header.php'
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Trial Balance</h1>
          <br>
          <h1>Ending on <?php
          $number = date("t");
          $ends = array('th','st','nd','rd','th','th','th','th','th','th');
          if (($number %100) >= 11 && ($number%100) <= 13)
             $abbreviation = $number. 'th';
          else
             $abbreviation = $number. $ends[$number % 10];
          echo $abbreviation;
   ?>
   of April</h1>

        </div>
      </div>
      <div class="row">

      </div>
    </div>
  </div>
<!--add new account-->
  <nav class="navbar navbar-light bg-light">
</nav>


<?php
include_once 'user.footer.php'
?>
