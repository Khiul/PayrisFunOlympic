<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('location:../login_form.php');
} else {
    include 'header.php';
?>
    <!-- dashboard start -->
    <div class="container-fluid" style="padding-top:20px">
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
                <h2 class="display-4">View All Booked Tickets</h2>
                <table class="table table-info table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Events</th>
                            <th>Number of Tickets</th>
                            <th>Date</th>
                            <th>Action</th> <!-- New column for delete button -->
                        </tr>
                    </thead>
                    <?php
                    include '../config.php';
                    $query = "SELECT * FROM tickets";
                    $run = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($run)) {
                        $a = $row['id'];
                        $b = $row['fullname'];
                        $c = $row['email'];
                        $d = $row['events'];
                        $e = $row['tickets'];
                        $f = $row['date'];
                    ?>
                        <tbody>
                            <tr>
                                <td scope="row"><?php echo $a; ?></td>
                                <td><?php echo $b; ?></td>
                                <td><?php echo $c; ?></td>
                                <td><?php echo $d; ?></td>
                                <td><?php echo $e; ?></td>
                                <td><?php echo $f; ?></td>
                                <td><a href="delete-booking.php?id=<?php echo $a; ?>" class="btn btn-danger btn-sm">Delete</a></td> <!-- Delete button -->
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- dashboard end -->
<?php
}
?>
