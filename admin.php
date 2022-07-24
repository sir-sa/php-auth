<?php
    session_start();
?>

<?php 
    include "header.php";
    include "access.php";

    access("ADMIN");
 ?>

    <span>
        <?php 

        // print_r($_SESSION);
            if(isset($_SESSION['myname'])){
                echo 'Hi  '  . $_SESSION['myname'];
            }
        ?>
    </span>
  
  <h1>This is the admin page</h1>

<?php include "footer.php" ?>