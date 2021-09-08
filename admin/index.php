<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<?php 
 if(!isset($_SESSION['user'])){

    $_SESSION['no-seesion-message' ]=  "<div> PLesase login </div>";
     header("location:login.php");
 }
?>
<?php 
  
   $conn = mysqli_connect('localhost','root','','food');
   if($conn){
       echo "Database connected";
   }
   else{
       echo "Failed to connet ";
   }
?>
<div class="topnav">
  <a class="active" href="../index.phpp">Home</a>
  <a href="admin.php">admin</a>
  <a href="order.php">order</a>
 
  <a href="food.php">food</a>
  <a href="logout.php">Logout</a>
</div>

<div style="padding-left:16px">

 <!--DAtabase -->
 <?php
  session_start();
 if(isset($_POST['submit'])){
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']);

   $sql = "INSERT INTO tbl_admin SET
   full_name = '$full_name',
   username = '$username',
   password = '$password'
   
   ";

   $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
   if($res==true){
      
      echo "Added admin";
      
   
   }
   else{
       echo "failed";
   }
 }
 ?>
 

  <!--DAtabase -->

<form action="" method="POST">
  <div class="container">
    <h1>Add Admin</h1>
    
    <hr>
    <label for="full_name"><b>full name</b></label>
    <input type="text" placeholder="name" name="full_name"  required>
    <label for="email"><b>username</b></label>
    <input type="text" placeholder="username" name="username"required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password"  required>
  <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" name="submit" class="registerbtn">ADD Admin</button>
  </div>
  
</form>
</div>

</body>
</html>
