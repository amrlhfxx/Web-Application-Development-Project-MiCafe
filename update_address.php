<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['unit'] .', '.$_POST['address1'].', '.$_POST['address2'].', '.$_POST['postal_code'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'Address Saved!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Address</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>your address</h3>
      <input type="text" class="box" placeholder="Unit Number" required maxlength="50" name="unit">
	   
      <input type="text" class="box" placeholder="Address Line 1" required maxlength="50" name="address1">
	   
      <input type="text" class="box" placeholder="Address Line 2" required maxlength="50" name="address2">
	   
      <input type="number" class="box" placeholder="Postal Code" required max="999999" min="0" maxlength="6" name="postal_code">
	   
      <input type="text" class="box" placeholder="City Name" required maxlength="50" name="city">
	   
      <input type="text" class="box" placeholder="State Name" required maxlength="50" name="state">
	   
      <input type="text" class="box" placeholder="Country Name" required maxlength="50" name="country">
	   
      
	   
      <input type="submit" value="save address" name="submit" class="btn">
   </form>

</section>




<?php include 'components/footer.php' ?>



<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>