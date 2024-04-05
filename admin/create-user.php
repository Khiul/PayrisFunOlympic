<?php
include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Added password field
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashing the password

    $insert_query = "INSERT INTO user_form (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    mysqli_query($conn, $insert_query);
    
    header('location: manage-users.php');
    exit;
}

include 'header.php';
?>

<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">Create User</h1>
            <form method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <!-- Added password field -->
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <!-- You may add more fields here as needed -->
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
