<!DOCTYPE html>
<html>
    <body>
        <?php
        $con = mysqli_connect("localhost","torresro_robert","nullMount94?","torresro_keepingtabs");
        
        if(mysqli_connect_errno()){
            echo "failed to connect". mysqli_connect_error();
        }
        
         if(mysqli_ping($con)){
             echo "connection okay";
             
         }
         
         else
         {
             echo "Error: ". mysqli_error($con);
         }
         
         mysqli_close($con);
        
        ?>
        
    </body>
    
</html>