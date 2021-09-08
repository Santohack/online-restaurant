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
   

 $id = $_GET['id'];
 $sql = "SELECT * FROM tbl_admin WHERE id ='$id' ";
 $res = mysqli_query($conn,$sql);
 if($res == true){
     $count = mysqli_num_rows($res);
     if($count== 1){

    
            
      while($rows = mysqli_fetch_assoc($res)){
      $full_name = $rows['full_name'];
         $username = $rows['username'];
     }
     }
     else{
         echo "user not available";
     }
 }

?>
<div class="topnav">
  <a class="active" href="../index.php">Home</a>
  <a href="admin.php">admin</a>
  <a href="order.php">order</a>

  <a href="food.php">food</a>
  <a href="logout.php">Logout</a>
</div>

<div style="padding-left:16px">


<form action="" method="POST">
  <div class="container">
    <h1>Update Admin</h1>
    <?php 
     session_start();
     if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $full_name = $_POST['full_name'];
       $username = $_POST['username'];


       $sql = "UPDATE tbl_admin SET
       full_name = '$full_name',
       username = '$username'
       WHERE id = '$id'
    ";

    $res = mysqli_query($conn,$sql);
    if($res == true){
        echo "UPDATED";

    }
    else{
        echo "SORRY ";
    }
     }
    ?>
 

    <hr>
    <label for="full_name"><b>full name</b></label>
    <input type="text"  name="full_name" value="<?php echo $full_name ?>"  required>
    <label for="email"><b>username</b></label>
    <input type="text"  name="username" value="<?php echo $username; ?>" required>
<input type="hidden" name="id" value="<?php echo $id; ?>">
    
  <hr>
   
      
    <button type="submit" name="submit" class="registerbtn">Update Admin</button>
  </div>
  
</form>
</div>

</body>
</html>
