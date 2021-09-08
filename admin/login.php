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
   $conn = mysqli_connect('localhost','root','','food');
   if($conn){
       echo "Database connected";
   }
   else{
       echo "Failed to connet ";
   }
?>


<div style="padding-left:16px">

 <!--DAtabase -->
 <?php
  session_start();
 if(isset($_POST['submit'])){
     $username = $_POST['username'];
     $password = md5($_POST['password']);

   $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'
   ";

   $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
   if($res==true){
      
    $_SESSION['user'] = $username;
    header('Location:admin.php');
   
   }
   else{
       echo "failed";
   }
 }
 ?>

  <!--DAtabase -->

<form action="" method="POST">
  <div class="container">
    <h1>LogIn</h1>
    
    <hr>
    
    <label for="email"><b>username</b></label>
    <input type="text" placeholder="username" name="username"required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password"  required>
  <hr>
    

    <button type="submit" name="submit" class="registerbtn">Login</button>
  </div>
  
</form>
</div>

</body>
</html>
