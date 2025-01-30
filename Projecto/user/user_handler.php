<?php
include('data.php');

if(isset($_POST['save_data'])){
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);

    $sql = "INSERT INTO user (name) VALUES ('$user_name')";
    $insert_user = mysqli_query($conn, $sql);

    if ($insert_user) {
        echo "<script>alert('New user added successfully'); window.location.href='../user.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}


?>


