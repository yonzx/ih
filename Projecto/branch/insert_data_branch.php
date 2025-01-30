<?php
    include("data.php");

    if (isset($_POST['addBranch'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $zip = $_POST['zip'];
        $email = $_POST['email'];
        $createdBy = $_POST['createdBy'];
        $deletedBy = $_POST['deletedBy'];

        if (empty($name) || empty($contact) || empty($address) || empty($zip) || empty($email) || empty($createdBy)) {
            header('location: ../branch.php?message=You need to fill in all fields!');
        } else {
            $query = "INSERT INTO branch (name, contact, address, zip, email, createdBy, deletedBy) 
                      VALUES ('$name', '$contact', '$address', '$zip', '$email', '$createdBy', '$deletedBy')";
        
            $result = mysqli_query($connection, $query);
        
            if (!$result) {
                echo'<script> alert("Customer insert failed.'. mysqli_error($connection). '");window.location.href="../branch.php"</script>';
            } else {
                echo"<script>alert('Customer Added successfully.'); window.location.href='../branch.php'</script>";
            }
        }
    }
?>