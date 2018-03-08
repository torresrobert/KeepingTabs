<?php
include_once "user.header.php"
 ?>
 <?php
 include '../includes/dbh.inc.php';
 $sql = "SELECT * FROM Users WHERE isActive = '1'";
 $records = mysqli_query($conn, $sql);
 ?>

 <!--Header-->
 <div class="text-center bg-warning text-white py-5">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <h1 class="display-5 text-danger"><strong>Modifying User Information</strong></h1>
         </div>
       </div>
       <div class="row">
         <div class="col-12">
           <a href="#" class="text-white" target="_blank">Missing something? You can submit a new ticket here.</a>
         </div>
       </div>
     </div>
   </div>

 <!--Search user directory-->
 <nav class="navbar navbar-light bg-light">

   <a class="btn btn-outline-primary span4" href="user_dir.php" role="button"> <i class="	fa fa-chevron-left"></i> User Directory</a>'
   <?php
   if (($_SESSION['u_atype']=='admin')){
     echo '<a class="btn btn-primary span4" href="add_user.php" role="button">Add user</a>';
   }
   ?>
 </nav>


 <!--Table of users-->

 <div class="container">
   <div class="table-responsive">
     <div id="new-search-area"></div>
 <table id="user_dir" class="table table-striped table-bordered" cellspacing="0" width="100%">
 <thead>
 <tr>
 <th>Username</th>
 <th>First</th>
 <th>Last</th>
 <th>Role</th>
 <th>Create On</th>
 </tr>
 </thead>
 <tbody>
 <?php
while ($rows = mysqli_fetch_assoc($records)) {
 ?>
 <tr>
 <td contenteditable="true" data-old_value="<?php echo $rows["username"]; ?>" onBlur="saveInlineEdit(this,'username','<?php echo $rows["id"]; ?>')" onClick="highlightEdit(this);"><?php echo $rows["username"]; ?></td>
 <td contenteditable="true" data-old_value="<?php echo $rows["firstName"]; ?>" onBlur="saveInlineEdit(this,'firstName','<?php echo $rows["id"]; ?>')" onClick="highlightEdit(this);"><?php echo $rows["firstName"]; ?></td>
 <td contenteditable="true" data-old_value="<?php echo $rows["lastName"]; ?>" onBlur="saveInlineEdit(this,'lastName','<?php echo $rows["id"]; ?>')" onClick="highlightEdit(this);"><?php echo $rows["lastName"]; ?></td>
 <td contenteditable="true" data-old_value="<?php echo $rows["accountType"]; ?>" onBlur="saveInlineEdit(this,'accountType','<?php echo $rows["id"]; ?>')" onClick="highlightEdit(this);"><?php echo $rows["accountType"]; ?></td>
 <td><?php echo $rows["createdOn"]; ?></td>
 </tr>
 <?php
 }
 ?>
 </tbody>
 </table>
</div>
</div>


    <?php
    include_once "user.footer.php"
     ?>
