<?php
include('data.php');

// Assuming you have a session variable for the logged-in user
session_start();
$deletedBy = $_SESSION['username']; // or however you store the username

if (isset($_POST['id'])) {
    $visit_id = $_POST['id'];

    // First, update the deletedBy field before deleting
    $sql = "UPDATE visit SET deletedBy = '$deletedBy' WHERE id = '$visit_id'";
    $update_delete = mysqli_query($conn, $sql);

    if ($update_delete) {
        // Now delete the visit
        $sql = "DELETE FROM visit WHERE id = '$visit_id'";
        $delete_visit = mysqli_query($conn, $sql);

        if ($delete_visit) {
            echo "<script>alert('Visit deleted successfully'); window.location.href='../visit.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='../visit.php';</script>";
        }
    } else {
        echo "<script>alert('Error updating deletedBy: " . mysqli_error($conn) . "'); window.location.href='../visit.php';</script>";
    }
}
?>