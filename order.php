<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <section >
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
              
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
       
if(isset($_GET['food_id'])){
     $food_id = $_GET['food_id'];
     $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'";
     $res = mysqli_query($conn,$sql);
     $count = mysqli_num_rows($res);
     if($count==1){
         while($rows = mysqli_fetch_assoc($res)){

            $title = $rows['title'];
            $price =$rows['price'];
            
         }
     }else{
         echo "not selected";
     }

}
else{
    echo "food not selected";
}

  ?>

                    <div class="food-menu-img">
                        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">₹<?php echo $price; ?></p>
                       
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty"  value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <?php 
        
        if(isset($_POST['submit'])){
            $food = $_POST['food'];
            $price =$_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("y-m-d h:i:sa");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_email = $_POST['email'];
            $customer_contact = $_POST['contact'];
            $customer_address = $_POST['address'];

            $sql1 = "INSERT INTO tbl_order SET
             food='$food',
             price = '$price',
             qty = '$qty',
             total = '$total',
             order_date = '$order_date',
             status = '$status',
             customer_name='$customer_name',
             customer_email ='$customer_email',
             customer_contact = '$customer_contact',
             customer_address = '$customer_address'
             ";
             $res2 = mysqli_query($conn,$sql1);
             if($res2==true){

                 echo "Ordered Successfully";
             }else{
                 echo " sorry we can't add you order";
             }
        }
    ?>

                    <div class="order-label">Full Name</div>
                   
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <input type="text" name="full-name" placeholder="name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Mobile number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Email" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="3" placeholder=" Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>


</body>
</html>