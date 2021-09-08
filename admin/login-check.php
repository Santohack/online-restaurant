<?php 
 if(!isset($_SESSION['user'])){

    $_SESSION['no-seesion-message' ]=  "<div> PLesase login </div>";
     header("location:login.php");
 }
?>