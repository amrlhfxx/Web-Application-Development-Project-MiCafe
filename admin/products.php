<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION[ 'admin_id' ];

if ( !isset( $admin_id ) ) {
    header( 'location:admin_login.php' );
};

if ( isset( $_POST[ 'add_product' ] ) ) {

    $name = $_POST[ 'name' ];
    $name = filter_var( $name, FILTER_SANITIZE_STRING );
    $price = $_POST[ 'price' ];
    $price = filter_var( $price, FILTER_SANITIZE_STRING );
    $category = $_POST[ 'category' ];
    $category = filter_var( $category, FILTER_SANITIZE_STRING );

    $image = $_FILES[ 'image' ][ 'name' ];
    $image = filter_var( $image, FILTER_SANITIZE_STRING );
    $image_size = $_FILES[ 'image' ][ 'size' ];
    $image_tmp_name = $_FILES[ 'image' ][ 'tmp_name' ];
    $image_folder = '../uploaded_img/' . $image;

    $select_products = $conn->prepare( "SELECT * FROM `products` WHERE name = ?" );
    $select_products->execute( [ $name ] );

    if ( $select_products->rowCount() > 0 ) {
        $message[] = 'Product name already exists!';
    } else {
        if ( $image_size > 2000000 ) {
            $message[] = 'Image size is too large';
        } else {
            move_uploaded_file( $image_tmp_name, $image_folder );

            $insert_product = $conn->prepare( "INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)" );
            $insert_product->execute( [ $name, $category, $price, $image ] );

            $message[] = 'New product added!';
        }

    }

}

if ( isset( $_GET[ 'delete' ] ) ) {

    $delete_id = $_GET[ 'delete' ];
    $delete_product_image = $conn->prepare( "SELECT * FROM `products` WHERE id = ?" );
    $delete_product_image->execute( [ $delete_id ] );
    $fetch_delete_image = $delete_product_image->fetch( PDO::FETCH_ASSOC );
    unlink( '../uploaded_img/' . $fetch_delete_image[ 'image' ] );
    $delete_product = $conn->prepare( "DELETE FROM `products` WHERE id = ?" );
    $delete_product->execute( [ $delete_id ] );
    $delete_cart = $conn->prepare( "DELETE FROM `cart` WHERE pid = ?" );
    $delete_cart->execute( [ $delete_id ] );
    header( 'location:products.php' );

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products</title>

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/admin_header.php' ?>
<section class="add-products">

<!-- Redirect to add.php directly --> 
<a href="add_products.php" class="btn">Add New Product</a> 

<!-- Show products section -->
<section class="show-products">
  <h1 class="heading">Product Lists</h1>
  <div class="table-container">
    <table class="message-table">
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Category</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $show_products = $conn->prepare( "SELECT * FROM `products`" );
        $show_products->execute();
        if ( $show_products->rowCount() > 0 ) {
            while ( $fetch_products = $show_products->fetch( PDO::FETCH_ASSOC ) ) {
                ?>
        <tr>
          <td><?= $fetch_products['id']; ?></td>
          <td><?= $fetch_products['name']; ?></td>
          <td>RM
            <?= $fetch_products['price']; ?>
            /-</td>
          <td><?= $fetch_products['category']; ?></td>
          <td><img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="Product Image" width="100"></td>
          
			<td>
			<a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
			  
			  
            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a></td>
        </tr>
        <?php
        }
        } else {
            echo '<tr><td colspan="6" class="empty">No products added yet!</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</section>
</body>
</html>
