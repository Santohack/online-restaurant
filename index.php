<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Tracking</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>




            <!-- Database -->
            <?php 
   $conn = mysqli_connect('localhost','root','','food');
   if($conn){
       echo "";
   }
   else{
       echo "Failed to connet ";
   }
?>
  <!-- ENd Database -->



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
                 $featured = $rows['featured'];
                 $active = $rows['active'];

                 ?>

<div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title ?></h4>
                    <p class="food-price">₹<?php echo $price ?></p>
                    <p class="food-detail">
                    <?php echo $discription ?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                </div>
                </div>
                 <?php
             }
         }
     }
  ?>




           
          




    </section>



</body>

</html>