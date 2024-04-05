<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit;
}
// Calculate the next broadcast schedule
$currentDateTime = new DateTime();
$nextScheduleDateTime = new DateTime('2024-06-17 14:00:00'); 
$nextScheduleFormatted = $nextScheduleDateTime->format('F j, Y \a\t H:i:s');

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payris Fun Olympic 2024</title>

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
    <link rel="stylesheet" href="assets/css/mystyle.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="assets/css/mystyle.css">

</head>

<!-- navbar start -->   
<nav class="navbar navbar-expand-sm navbar-dark bg-info">
    <a class="navbar-brand" href="main.php"><img src="assets/images/logo2.png" alt="" style="width: 100px; height: auto;">
Payris Fun Olympic 2024</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php"><i class="fa fa-info-circle"></i> About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gallery.php"><i class="fa fa-image"></i> Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="video-gallery.php"><i class="fa fa-play-circle"></i> Videos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="booking.php"><i class="fa fa-play-circle"></i>Book Ticket</a>
            </li>
            <li class="nav-item">
                <span class="nav-link"><i class="fa fa-user"></i> <?php echo $_SESSION['user_name']; ?></span>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- navbar end -->

<!-- content start -->
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="display-4 text-center" style="margin-bottom: 30px; font-size:50px; font-weight:bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Payris Fun Olympic 2024 - Broadcast Video</h2>

            <div class="card-deck">
                <div class="card">
                    <div class="card-body">
                        <h2>All Videos</h2>
                        <img src="assets/images/cup.png" alt="">
                        <?php
                        $videoDir = glob('assets/videos/{*.mp4}', GLOB_BRACE);
                        if (empty($videoDir)) {
                            echo "<p>No videos available.</p>";
                        } else {
                            foreach ($videoDir as $value) {
                        ?>
                                <div class="video-card">
                                    <video width="100%" height="240" controls>
                                        <source src="<?php echo $value; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content end -->

<!-- Next broadcast schedule -->
<div class="container">
        <h2 class="text-center">Next Broadcast Schedule</h2>
        <p class="text-center">The next broadcast will be on <?php echo $nextScheduleFormatted; ?></p>
</div>
<hr>
<?php
include 'footer.php';
?>
