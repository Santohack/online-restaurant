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
 $sql = "SELECT * FROM tbl_food WHERE id ='$id' ";
 $res = mysqli_query($conn,$sql);
 if($res == true){
     $count = mysqli_num_rows($res);
     if($count== 1){

    
            
      while($rows = mysqli_fetch_assoc($res)){
          $id = $rows['id'];
      $title = $rows['title'];
      $discription = $rows['discription'];
      $price = $rows['price'];
      $featured = $rows['featured'];
      $active = $rows['active'];


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


    <?php 
     session_start();
     if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $title = $_POST['title'];
      $discription = $_POST['discription'];
      $price = $_POST['price'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];

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
       

       $sql = "UPDATE tbl_food  SET
        title = '$title',
         discription= '$discription',
         price = '$price',
         image = ' $fileNameNew',
         featured = '$featured',
         active = '$active'
         WHERE id='$id'
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
 

 <form action="" method="POST" enctype="multipart/form-data">
  <div class="container">
    <h1>Update FOod</h1>
    
    <hr>
    
    <label for="email"><b>Title</b></label>
    <input type="text" placeholder="title" name="title" value="<?php echo $title ?>"  required>

    <label for="psw"><b>Discription</b></label>
    <input type="text" placeholder="discription for food" name="discription"  value="<?php echo $discription ?>" required>
    <label for="email"><b>Price</b></label>
    <input type="text" placeholder="price" name="price" value="<?php echo $price ?>" required>

    <label for="psw"><b>select Food image</b></label>
    <input type="file"  name="image"  >
    <label for="email"><b>Featured</b></label>
    <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">yes
    <input  <?php if($featured=="no"){echo "checked";} ?>  type="radio" name="featured" value="no">No
    
    <label for="psw"><b>Active</b></label>
    <input  <?php if($active=="yes"){echo "checked";} ?>  type="radio" name="active" value="yes">yes
    <input  <?php if($active=="no"){echo "checked";} ?>  type="radio" name="active" value="no">No
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
  <hr>
    

    <button type="submit" name="submit" class="registerbtn">Update Food</button>
  </div>
  
</form>
</div>

</body>
</html>
