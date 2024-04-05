<?php
include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['video'])) {
    $video_name = $_FILES['video']['name'];
    $video_tmp = $_FILES['video']['tmp_name'];
    $video_type = $_FILES['video']['type'];

    // Define your upload directory
    $upload_dir = "../assets/videos/";

    // Check if the uploaded file is a video
    if ($video_type == "video/mp4" || $video_type == "video/webm" || $video_type == "video/ogg") {
        // Generate a unique name for the video file
        $video_path = $upload_dir . uniqid() . '_' . $video_name;

        // Move the uploaded video to the desired directory
        if (move_uploaded_file($video_tmp, $video_path)) {
            // Insert video path into the database
            $insert_query = "INSERT INTO videos (video_path) VALUES ('$video_path')";
            mysqli_query($conn, $insert_query);

            // Redirect back to the admin dashboard or any other desired page
            header('location: main.php');
            exit;
        } else {
            $error = "Failed to upload video.";
        }
    } else {
        $error = "Please upload a valid video file (MP4, WebM, or OGG).";
    }
}

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
        <div class="col-md-8">
            <h1 class="display-4">Upload Video</h1>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="video">Select Video File:</label>
                    <input type="file" class="form-control" id="video" name="video" required accept="video/mp4,video/webm,video/ogg">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>
