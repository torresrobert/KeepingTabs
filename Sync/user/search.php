<?php
include_once 'user.header.php';
include '../includes/dbh.inc.php';
?>

<div class="text-center bg-primary text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Search Results</h1>
        </div>
      </div>
    </div>
  </div>
<!--display table-->

<div class="container">

  <div class="row">
    <div class="col-2">
    </div>
    <div class="col">

<?php
    $query = $_GET['query'];
    // gets value sent over search form

    $min_length = 3;
    // you can set minimum length of the query if you want

    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

        $query = mysqli_real_escape_string($conn,$query);
        // makes sure nobody uses SQL injection

        $raw_results = mysqli_query($conn,"SELECT * FROM SiteIndex
            WHERE (`name` LIKE '%".$query."%') OR (`tags` LIKE '%".$query."%')") or die(mysqli_error($conn));

        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table

        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'

        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysqli_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                echo "<br><h3><a href='".$results['url']."'>".$results['name']."</a></h3><p>".$results['description']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }

        }
        else{ // if there is no matching rows do following
            echo "No results";
        }

    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }

    echo "<br><br><br><br><br>";

?>
<?php
echo "<div class='text-center'><h3> Still need help?</h3>";
if (($_SESSION['u_atype']=='user')||($_SESSION['u_atype']=='manager')){
echo '<a class="btn btn-primary btn-lg span4" href="#" role="button">Contact Admin</a>';
}else if (($_SESSION['u_atype']=='admin')){
echo '<a class="btn btn-primary btn-lg span4" href="#" role="button">Contact KeepingTabs</a>';
echo "</div>";
}
?>
</div>
<div class="col-2">
</div>
</div>
</div>

<?php
include_once 'user.footer.php';
?>
