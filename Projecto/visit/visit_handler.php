<?php
include('data.php');

// Assuming you have a session variable for the logged-in user
session_start();
$createdBy = $_SESSION['username']; // or however you store the username

if(isset($_POST['save_data'])){
    $customerId = mysqli_real_escape_string($conn, $_POST['customerId']);
    $branchId = mysqli_real_escape_string($conn, $_POST['branchId']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $createdBy = mysqli_real_escape_string($conn, $_POST['createdBy']);

    $sql = "INSERT INTO visit (customerId, branchId, date, time, createdBy) VALUES ('$customerId', '$branchId', '$date', '$time', '$createdBy')";
    $insert_visit = mysqli_query($conn, $sql);

    if ($insert_visit) {
        echo "<script>alert('New visit added successfully'); window.location.href='../visit.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>