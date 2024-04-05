<?php

require 'config.php';
session_start();

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];

   $selectAdmin = "SELECT * FROM user_form WHERE user_type = 'admin'";
   $adminResult = mysqli_query($conn, $selectAdmin);
   $error = array();

   if (mysqli_num_rows($adminResult) > 0 && $user_type === 'admin') {
      $error[] = 'There is already an admin.';
   } else {
      $select = "SELECT * FROM user_form WHERE email = '$email'";
      $result = mysqli_query($conn, $select);

      if (mysqli_num_rows($result) > 0) {
         $error[] = 'User already exists!';
      } else {
         if ($pass != $cpass) {
            $error[] = 'Password not matched!';
         } else {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$hashed_password','$user_type')";
            mysqli_query($conn, $insert);
            $_SESSION['success_message'] = 'Registration successful. You can now login.';
            header('location:login.php');
            exit;
         }
      }
   }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payris- Fun Olympic 2024</title>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   <!-- Bootstrap Icon -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <link rel="shortcut icon" href="assets/images/logo2.png" type="image/x-icon">


   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

   <!-- navbar start -->
   <nav class="navbar navbar-expand-sm navbar-dark bg-info">
      <a class="navbar-brand" href="index.php"><img src="assets/images/logo2.png" alt="" style="width: 100px; height: auto;">
Payris Fun Olympic 2024</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
         <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
         </ul>

      </div>
   </nav>
   <!-- navbar end -->

   <div class="container d-flex flex-column my-4">

      <form action="" method="post">
         <h3>Register now</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $err) {
               echo '<div class="alert alert-danger" role="alert">' . $err . '</div>';
            }
         }
         ?>
         <input type="text" name="name" required placeholder="Enter Your Name" class="form-control mb-3">
         <input type="email" name="email" required placeholder="Enter Your Email" class="form-control mb-3">
         <input type="password" id="password" name="password" required placeholder="Enter Your Password" class="form-control mb-3">
         <input type="password" id="confirm_password" name="cpassword" required placeholder="Confirm Your Password" class="form-control mb-3">
         <select name="user_type" class="form-control mb-3">
            <option value="user">User</option>
            <option value="admin">Admin</option>
         </select>
         <input type="submit" name="submit" value="REGISTER" class="btn btn-primary">
         <p>Already have an account? <a href="login.php">Login Now</a></p>
      </form>

   </div>
   <?php
include 'footer.php';
?>
</body>

</html>
