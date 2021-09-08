<?php 
 session_start();
    $conn = mysqli_connect('localhost','root','','food');
    if($conn){
        echo "Database connected";
    }
    else{
        echo "Failed to connet ";
    }


    $id = $_GET['id'];
    $sql = "DELETE  FROM tbl_admin WHERE id = '$id'";
    $res = mysqli_query($conn,$sql);
    if($res== true){
        header('Location:admin.php');
    }
    else{
        echo "not deleted";
    }
?>