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
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>
<?php
if (($_SESSION['u_atype']=='admin')){
 echo '<div>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
  </div>';
}
?>


<?php
include_once 'user.footer.php';
?>
