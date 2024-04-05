<?php
include '../config.php';
session_start();
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare the SQL query
    $query = "DELETE FROM tickets WHERE id = '$userId'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Deletion successful
        header('location:view-booking.php');
        // "User deleted successfully."
    } else {
        // Deletion failed
        echo "Failed to delete user.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
