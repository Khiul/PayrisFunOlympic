<?php
include 'header.php';

// Database configuration
include 'config.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $a = $_POST['fullname'];
    $b = $_POST['email'];
    $c = $_POST['events'];
    $d = $_POST['tickets'];
    $e = $_POST['date'];

    // SQL query to insert data into the database
    $query = "INSERT INTO tickets(fullname, email, events, tickets, date) VALUES ('$a', '$b', '$c', '$d', '$e')";
    
    // Execute the query
    $run = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if ($run) {
        echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        Booked Successfully!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Error Found, Try Again!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}
?>
    
<!-- welcome start -->
<h2 class="display-4 text-center font-weight-bold">Payris Fun Olympic 2024 - Book Ticket</h2>
<!-- welcome end -->

<!-- content start -->
<div class="container">
        <div class="row">
            <div class="col-md-9">
                <form action="" method="post">
                    <h2 class="display-4">Book Now</h2>
                    <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" aria-describedby="helpId" required autofocus>
                        <small id="helpId" class="text-muted"></small>
                    </div>

                    <!-- email -->
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email" required>
                    </div>
                    <!-- subject Web Development Desktop Application Mobile Application CCNA -->
                    <div class="form-group">
                        <label for="events">Select Event:</label>
                        <select class="form-control" name="events" id="events" required>
                            <option value="">-- Select Event --</option>
                            <option value="swimming">Swimming</option>
                            <option value="soccer">Soccer</option>
                            <option value="athletics">Athlete</option>
                            <option value="gymnastics">Volleyball</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tickets">Number of Tickets:</label>
                        <input type="number" class="form-control" name="tickets" id="tickets" aria-describedby="helpId" min="1" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date" id="date" aria-describedby="helpId"  placeholder="" required>
                    </div>
                    <!-- submit b4-form-submit -->
                    <button type="submit" class="btn btn-primary btn-lg" name="submit">Book Now</button>
                    <!-- cancel b4-form-reset -->
                    <button type="reset" class="btn btn-danger btn-lg">Cancel</button>


                </form>
            </div>
            <div class="col-md-3">
                <img src="assets/images/slide1.jpg" alt="add" class="img-thumbnail">
                <img src="assets/images/slide2.jpg" alt="add" class="img-thumbnail">
                <img src="assets/images/slide3.jpg" alt="add" class="img-thumbnail">
                <img src="assets/images/slide4.jpg" alt="add" class="img-thumbnail">

            </div>
        </div>
    </div>
    <!-- content end -->
<hr>
<?php
include 'footer.php';
?>
