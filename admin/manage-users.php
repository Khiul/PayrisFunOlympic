<?php
include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../login.php');
    exit; // Ensure script execution stops after redirect
}

// Fetch user data from database
$query = "SELECT * FROM user_form WHERE user_type='user'";
$result = mysqli_query($conn, $query);

// Check if any users are found
if (mysqli_num_rows($result) > 0) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $users = []; // Empty array if no users found
}

include 'header.php'; // Include admin header
?>

<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
    <div class="col-md-4">
            <div style="background-color:#99caff;border-radius:10px;padding:20px;">
                <h2 class="display-4 text-center"> <i class="fa fa-dashboard" style="font-size: 60px;"></i> Dashboard</h2>
                <a href="manage-users.php" class="btn btn-primary btn-block btn-lg">Manage Users</a>
                <a href="upload-video.php" class="btn btn-primary btn-block btn-lg">Upload Video</a>
                <a href="view-booking.php" class="btn btn-primary btn-block btn-lg">View Booking</a>
            </div>
            </div>
        <div class="col-md-8">
            <h1 class="display-4">Manage Users</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <a href="edit-user.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete-user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="create-user.php"><button class='btn btn-primary'>Create user</button></a>
        </div>
    </div>
</div>
