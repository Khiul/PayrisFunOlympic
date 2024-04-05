<?php
include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        // You may add more fields here as needed

        $update_query = "UPDATE user_form SET name='$name', email='$email' WHERE id='$id'";
        mysqli_query($conn, $update_query);
        
        header('location: manage-users.php');
        exit;
    }

    $select_query = "SELECT * FROM user_form WHERE id='$id'";
    $result = mysqli_query($conn, $select_query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: manage-users.php');
    exit;
}

include 'header.php';
?>

<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">Edit User</h1>
            <form method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <!-- You may add more fields here as needed -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
