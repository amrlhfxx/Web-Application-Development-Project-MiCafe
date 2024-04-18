<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $order_status = $_POST['order_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET order_status = ? WHERE id = ?");
  
	$update_status->execute([$order_status, $order_id]);
   $message[] = 'Order status updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Order Lists</h1>

   <!-- Search Form -->
   <form action="" method="GET" class="search-form">
      <input type="text" name="search_name" placeholder="Search by Name">
      <button type="submit" class="btn">Search</button>
   </form>

   <div class="box-container">
   <?php
      // Check if there's a search query
      if(isset($_GET['search_name'])) {
         $search_name = $_GET['search_name'];
         // Modify SQL query to filter by Name
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE name LIKE ?");
         $select_orders->execute(["%$search_name%"]);
         
         // Check if any rows are returned
         if($select_orders->rowCount() > 0) {
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> User ID : <span><?= $fetch_orders['user_id']; ?></span> </p>
      <p> Placed On : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> Number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Total Products : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Total Price : <span>RM<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> Payment Method : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> Order Status : </p>
	   
      <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="order_status" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders['order_status']; ?></option>
            <option value="Processing">Processing</option>
            <option value="Completed">Completed</option>
         </select>
		  
         <div class="flex-btn">
            <input type="submit" value="update" class="option-btn" name="update_payment">
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </div>
      </form>
   </div>
   <?php
            }
         } else {
            // Display message if user not found
            echo '<p class="empty">User not found!</p>';
			 
         }
      } else {
         // Fetch all orders if no search query or no results found
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();

         // Display message if no orders are found
         if($select_orders->rowCount() === 0){
            echo '<p class="empty">No orders placed yet!</p>';
         }

         // Display all orders
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> User ID : <span><?= $fetch_orders['user_id']; ?></span> </p>
      <p> Placed On : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> Number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Total Products : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Total Price : <span>RM<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> Payment Method : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> Order Status : </p>
	   
      <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="order_status" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders['order_status']; ?></option>
            <option value="Processing">Processing</option>
            <option value="Completed">Completed</option>
         </select>
		  
         <div class="flex-btn">
            <input type="submit" value="update" class="option-btn" name="update_payment">
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </div>
      </form>
   </div>
   <?php
         } // Add this closing curly brace
      }
   ?>
   </div>
</section>

<!-- placed orders section ends -->


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
