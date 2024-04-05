<?php
include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../login.php');
} else {
?>
    <?php
    include 'header.php';
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

            <div class="col-md-6">
                <h1 class="display-4">Dashboard Statistics:</h1>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="display-8 text-center">Total Users:</h2>
                                <?php
                                // Total number of users
                                $query = "SELECT COUNT(*) as total FROM user_form WHERE user_type='user'";
                                $result = mysqli_query($conn, $query);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $userCount = $row['total'];
                                    echo "<h2 class='lead text-center'>" . $userCount . "</h2>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="display-8 text-center">Total Videos:</h2>
                                <?php
                                // Total number of videos
                                $videoCount = 0;
                                // Directory where videos are stored
                                $videosDirectory = "../assets/videos/";
                                // Get all files in the videos directory
                                $videos = glob($videosDirectory . "*");
                                // Count the number of video files
                                if ($videos !== false) {
                                    $videoCount = count($videos);
                                }
                                echo "<h2 class='lead text-center'>" . $videoCount . "</h2>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

    </html>
<?php
}
?>