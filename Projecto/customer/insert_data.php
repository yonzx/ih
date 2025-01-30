<?php
    include("dbcon.php");

    if (isset($_POST['addCustomer'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $middleName = $_POST['middleName'];
        $birthDate = $_POST['birthDate'];
        $contactNumber = $_POST['contactNumber'];
        $emailAddress = $_POST['emailAddress'];
        $createdBy = $_POST['createdBy'];
        $deletedBy = $_POST['deletedBy'];
        $BranchID = $_POST['BranchID'];

        if (empty($firstName) || empty($lastName) || empty($middleName) || empty($birthDate) || empty($contactNumber) || empty($emailAddress)) {
            header('location: customer.php?message=You need to fill in all fields!');
        } else {
            $query = "INSERT INTO customers (firstName, lastName, middleName, birthDate, contactNumber, emailAddress, createdBy, deletedBy, BranchID) 
                      VALUES ('$firstName', '$lastName', '$middleName', '$birthDate', '$contactNumber', '$emailAddress', '$createdBy', '$deletedBy', '$BranchID')";

            $result = mysqli_query($connection, $query);

            if (!$result) {
                echo'<script> alert("Costumer insert failed.'. mysqli_error($connection). '");window.location.href="../customer.php"</script>';
            } else {
                echo"<script>alert('Customer Added successfully.'); window.location.href='../customer.php'</script>";
            }
        }
    }
?>