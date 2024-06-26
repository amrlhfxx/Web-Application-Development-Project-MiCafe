<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Account Lists</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      /* Increase font size */
      table {
         border-collapse: collapse;
         width: 100%;
      }

      th, td {
         border: 2px solid #000;
         padding: 12px;
         text-align: left;
         font-size: 20px; /* Increased font size */
      }

      th {
         background-color: #f2f2f2;
      }

      /* Increase font size */
      .box p,
      .box span {
         font-size: 20px; /* Increased font size */
      }
      
      .register-container {
         margin-top: 30px;
		  font-size: 20px;
         text-align: center; /* Center align */
      }

      .register-btn {
         font-size: 20px; /* Increased font size */
         display: inline-block;
         width: auto; /* Reset width */
      }
   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>
	
	


<!-- admins accounts section starts  -->

<section class="accounts">

   <h1 class="heading">Admin Account List</h1>
	
	
	
</div>

   <table>
      <thead>
         <tr>
            <th>Admin ID</th>
            <th>Username</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
            $select_account = $conn->prepare("SELECT * FROM `admin`");
            $select_account->execute();
            if($select_account->rowCount() > 0){
               while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
         ?>
         <tr>
            <td><?= $fetch_accounts['id']; ?></td>
            <td><?= $fetch_accounts['name']; ?></td>
            <td>
               <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
               <?php
                  if($fetch_accounts['id'] == $admin_id){
                     echo '<a href="update_profile.php" class="option-btn">Update</a>';
                  }
               ?>
            </td>
         </tr>
         <?php
               }
            } else {
               echo '<tr><td colspan="3">No accounts available</td></tr>';
            }
         ?>
      </tbody>
   </table>

</section>

<!-- Register New Admin -->
<div class="register-container">
   <p>Register New Admin</p><a href="register_admin.php" class="option-btn register-btn">Register</a>
<!-- admins accounts section ends -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>



