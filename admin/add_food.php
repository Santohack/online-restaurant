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
<div class="topnav">
  <a class="active" href="../index.php">Home</a>
  <a href="admin.php">admin</a>
  <a href="order.php">order</a>
  <a href="food.php">food</a>
  <a href="logout.php">Logout</a>
</div>
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
     $title = $_POST['title'];
     $discription = $_POST['discription'];
     $price = $_POST['price'];


     if(isset($_POST['featured'])){
         $featured = $_POST['featured'];
     }
     else{
         $featured = "no";
     }
     if(isset($_POST['active'])){
        $active = $_POST['active'];
    }
    else{
        $active = "no";
    }
    if(isset($_POST['submit'])){
      $file = $_FILES['image'];
      $fileName = $_FILES['image']['name'];
      $fileTmpname = $_FILES['image']['tmp_name'];
      $fileSize = $_FILES['image']['size'];
      $fileType = $_FILES['image']['type'];
      $fileError = $_FILES['image']['error'];
      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allow = array('png','jpg','jpeg');
      if(in_array($fileActualExt,$allow)){
          if($fileError===0){
              if($fileSize<10000000){
                  $fileNameNew = uniqid('',true).'.'.$fileActualExt;
                  $fileDestination = '../images/food/'.$fileNameNew;
                  move_uploaded_file($fileTmpname,$fileDestination);
                  header("loaction:index.php?uploaded");

              }else{
                  echo "file is to big";
              }

          }else{
              echo " files have error";
          }

      }else{
          echo "you can not upload this type file";
      }
  }
     

   $sql = " INSERT INTO tbl_food SET
         title = '$title',
         discription= '$discription',
         price = '$price',
         image = ' $fileNameNew',
         featured = '$featured',
         active = '$active'
   ";

   $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
   if($res==true){
      echo "food Added";
   
   
   }
   else{
       echo "failed";
   }
 }
 ?>

  <!--DAtabase -->

<form action="" method="POST" enctype="multipart/form-data">
  <div class="container">
    <h1>Add FOod</h1>
    
    <hr>
    
    <label for="email"><b>Title</b></label>
    <input type="text" placeholder="title" name="title"required>

    <label for="psw"><b>Discription</b></label>
    <input type="text" placeholder="discription for food" name="discription"  required>
    <label for="email"><b>Price</b></label>
    <input type="text" placeholder="price" name="price"required>

    <label for="psw"><b>select Food image</b></label>
    <input type="file"  name="image"  required>
    <!--
    <label for="email"><b>Featured</b></label>
    <input type="radio" name="featured" value="yes">yes
    <input type="radio" name="featured" value="no">No
    
    <label for="psw"><b>Active</b></label>
    <input type="radio" name="active" value="yes">yes
    <input type="radio" name="active" value="no">No
-->
  <hr>
    

    <button type="submit" name="submit" class="registerbtn">Add Food</button>
  </div>
  
</form>
</div>

</body>
</html>
