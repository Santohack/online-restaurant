<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
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

<div class="topnav">
  <a class="active" href="../index.php">Home</a>
  <a href="admin.php">admin</a>
  <a href="order.php">order</a>
  <a href="food.php">food</a>
  <a href="logout.php">Logout</a>
</div>
          
<a href="add_food.php">ADD FOOD</a>
<div style="padding-left:16px">
<table id="customers">
  <tr>
    <th>id</th>
    <th> Food name</th>
    <th>Price</th>
    <th>Discription</th>
    <th>Food Image</th>
    <th>Update</th>
    <th>Delete</th>
  </tr>

  
  <?php 
  
       session_start();
     $sql = "SELECT * From tbl_food";
     $res = mysqli_query($conn,$sql);
     if($res== true){
         $count = mysqli_num_rows($res);
         $sn =1;
         if($count>0){
             while($rows= mysqli_fetch_assoc($res)){
                 $id =$rows['id'];
                 $title= $rows['title'];
                 $price = $rows['price'];
                 $discription = $rows['discription'];
                 $image = $rows['image'];
                

                 ?>

<tr>
    <td><?php echo $sn++; ?></td>
    <td><?php echo $title; ?></td>
    <td><?php echo $price; ?></td>
    <td><?php echo $discription; ?></td>
    <td><img  src='../images/food/$image' width='50px' height='40' alt='image'></td>
    <td><a href="update_food.php?id=<?php echo $id; ?>">update </a></td>
    <td><a href="delete_food.php?id=<?php echo $id; ?>">Delete</a></td>
  </tr>
  
                 <?php
             }
         }
     }
  ?>




</table>
</div>

</body>
</html>
