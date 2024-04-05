<?php
include '../config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_query = "DELETE FROM user_form WHERE id='$id'";
    mysqli_query($conn, $delete_query);

    header('location: manage-users.php');
    exit;
} else {
    header('location: manage-users.php');
    exit;
}
?>
