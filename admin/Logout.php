<?php 
session_destroy();
$conn = mysqli_connect('localhost','root','','food');
if($conn){
    echo "Database connected";
}
else{
    echo "Failed to connet ";
}

header('location:login.php');
 
?>