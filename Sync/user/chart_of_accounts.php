<?php
include_once 'user.header.php'
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Chart of Accounts</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="text-white" target="_blank">Missing something? You can request a new account here.</a>
        </div>
      </div>
    </div>
  </div>


<div>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Account #</th>
      <th scope="col">Account Name</th>
      <th scope="col">Account Type</th>
      <th scope="col">Is Active?</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">100</th>
      <td>Cash</td>
      <td>Asset</td>
      <td>Yes</td>
    </tr>
    <tr>
      <th scope="row">102</th>
      <td>Sale of goods</td>
      <td>Revenue</td>
      <td>Yes</td>
    </tr>
    <tr>
      <th scope="row">205</th>
      <td colspan="1">Employee Meals</td>
      <td>Expense</td>
      <td>No</td>
    </tr>
  </tbody>
</table>
  </div>


<?php
include_once 'user.footer.php'
?>
