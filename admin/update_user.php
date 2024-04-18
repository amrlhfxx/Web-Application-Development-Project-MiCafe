<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit(); // Ensure script stops executing after redirection
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $password = sha1($_POST['password']); // Hash the password
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $address = $_POST['address']; // Capture address

    $user_id = $_POST['user_id']; // Capture user ID from form

    $update_user = $conn->prepare("UPDATE `users` SET name = ?, email = ?, number = ?, password = ?, address = ? WHERE id = ?");
    $update_user->execute([$name, $email, $number, $password, $address, $user_id]);

    $message[] = 'User information updated successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- User edit section starts -->
<section class="form-container">

    <form action="" method="post">
        <h3>Edit User Information</h3>
        <?php
        // Fetch user details based on user ID
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_user->execute([$user_id]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
            ?>
            <input type="hidden" name="user_id" value="<?= $user_id ?>"> <!-- Hidden field to store user ID -->
            <input type="text" name="name" required placeholder="Enter User's Name" class="box" maxlength="50" value="<?= $row['name'] ?>">
            <input type="email" name="email" required placeholder="Enter User's Email" class="box" maxlength="50" value="<?= $row['email'] ?>">
            <input type="text" name="number" required placeholder="Enter User's Number" class="box" maxlength="10" value="<?= $row['number'] ?>">
            <input type="password" name="password" placeholder="Enter User's New Password" class="box" maxlength="50">
            <textarea name="address" placeholder="Enter User's Address" class="box" rows="4"><?= $row['address'] ?></textarea>
            <input type="submit" value="Update User" name="submit" class="option-btn">
		<a href="users_accounts.php" class="btn">Go Back</a> <!-- Go back button -->
        <?php } else {
            echo "User not found!";
        } ?>
    </form>

  

</section>
<!-- User edit section ends -->

</body>
</html>

