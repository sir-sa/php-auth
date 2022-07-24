<?php
    session_start();
?>

<?php 
    include "header.php";
    include "access.php";
 ?>

    <span>
        <?php 

        // print_r($_SESSION);
            if(isset($_SESSION['myname'])){
                echo 'Hi  '  . $_SESSION['myname'];
            }
        ?>
    </span>
  
  <h1>This is the home page</h1>

<?php include "footer.php" ?>