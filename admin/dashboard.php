<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION[ 'admin_id' ];

if ( !isset( $admin_id ) ) {
    header( 'location:admin_login.php' );
}

// Fetch admin's profile information
$select_profile = $conn->prepare( "SELECT name FROM admin WHERE id = ?" );
$select_profile->execute( [ $admin_id ] );
$fetch_profile = $select_profile->fetch( PDO::FETCH_ASSOC );

// Initialize variables
$total_pendings = 0;
$total_completes = 0;
$numbers_of_orders = 0;
$numbers_of_products = 0;
$numbers_of_users = 0;
$numbers_of_admins = 0;
$numbers_of_messages = 0;

// Fetch values from the database
$select_pendings = $conn->prepare( "SELECT SUM(total_price) AS total_pendings FROM `orders` WHERE order_status = 'Processing'" );
$select_pendings->execute();
$total_pendings_row = $select_pendings->fetch( PDO::FETCH_ASSOC );
$total_pendings = $total_pendings_row[ 'total_pendings' ];

$select_completes = $conn->prepare( "SELECT SUM(total_price) AS total_completes FROM `orders` WHERE order_status = 'Completed'" );
$select_completes->execute();
$total_completes_row = $select_completes->fetch( PDO::FETCH_ASSOC );
$total_completes = $total_completes_row[ 'total_completes' ];

$select_orders = $conn->prepare( "SELECT * FROM `orders`" );
$select_orders->execute();
$numbers_of_orders = $select_orders->rowCount();

$select_products = $conn->prepare( "SELECT * FROM `products`" );
$select_products->execute();
$numbers_of_products = $select_products->rowCount();

$select_users = $conn->prepare( "SELECT * FROM `users`" );
$select_users->execute();
$numbers_of_users = $select_users->rowCount();

$select_admins = $conn->prepare( "SELECT * FROM `admin`" );
$select_admins->execute();
$numbers_of_admins = $select_admins->rowCount();

$select_messages = $conn->prepare( "SELECT * FROM `messages`" );
$select_messages->execute();
$numbers_of_messages = $select_messages->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">
  <h1 class="heading">Admin Dashboard</h1>
  <div class="table-container">
    <table class="message-table">
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th>Value</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Welcome</td>
          <td><?= $fetch_profile['name']; ?></td>
          <td><button onclick="location.href='update_profile.php';" class="btn">Update Profile</button></td>
        </tr>
        <tr>
          <td>Total Processing</td>
          <td><span>RM&nbsp;</span>
            <?= $total_pendings; ?>
            <span>/-</span></td>
          <td><button onclick="location.href='placed_orders.php';" class="btn">See Orders</button></td>
        </tr>
        <tr>
          <td>Total Completes</td>
          <td><span>RM&nbsp;</span>
            <?= $total_completes; ?>
            <span>/-</span></td>
          <td><button onclick="location.href='placed_orders.php';" class="btn">See Orders</button></td>
        </tr>
        <tr>
          <td>Total Orders</td>
          <td><?= $numbers_of_orders; ?></td>
          <td><button onclick="location.href='placed_orders.php';" class="btn">See Orders</button></td>
        </tr>
        <tr>
          <td>Products Added</td>
          <td><?= $numbers_of_products; ?></td>
          <td><button onclick="location.href='products.php';" class="btn">See Products</button></td>
        </tr>
        <tr>
          <td>Users Accounts</td>
          <td><?= $numbers_of_users; ?></td>
          <td><button onclick="location.href='users_accounts.php';" class="btn">See Users</button></td>
        </tr>
        <tr>
          <td>Admins</td>
          <td><?= $numbers_of_admins; ?></td>
          <td><button onclick="location.href='admin_accounts.php';" class="btn">See Admins</button></td>
        </tr>
        <tr>
          <td>New Messages</td>
          <td><?= $numbers_of_messages; ?></td>
          <td><button onclick="location.href='messages.php';" class="btn">See Messages </button></td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<!-- admin dashboard section ends --> 

<!-- custom js file link  --> 
<script src="../js/admin_script.js"></script>
</body>
</html>
