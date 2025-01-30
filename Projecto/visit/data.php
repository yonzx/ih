<?php
$conn = mysqli_connect("localhost", "root", "", "loyalty_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
