<?php

require 'config.php';

session_start();

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = $_POST['password'];

   $select = "SELECT * FROM user_form WHERE email = '$email'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      $hashed_password = $row['password'];
      if (password_verify($password, $hashed_password)) {
         if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location: admin/main.php');
         } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            header('location: video-gallery.php');
         }
      } else {
         $error[] = 'Incorrect Email or Password!';
      }
   } else {
      $error[] = 'Incorrect Email or Password!';
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
        <h3>Login Now</h3>
        <?php
        if (isset($error)) {
            foreach ($error as $err) {
                echo '<div class="alert alert-danger" role="alert">' . $err . '</div>';
            }
        }
        ?>
        <input type="email" name="email" required placeholder="Enter Your Email" class="form-control mb-3">
        <input type="password" name="password" required placeholder="Enter Your Password" class="form-control mb-3">
        <input type="submit" name="submit" value="LOGIN" class="btn btn-primary">
        <p class="mt-3">Don't have an account? <a href="register.php">Register Now</a></p>
    </form>
</div>
<hr>
<?php
include 'footer.php';
?>


</body>

</html>
