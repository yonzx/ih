<?php
include("dbcon.php");

// Initialize $row to avoid undefined variable notice
$row = null; 

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    // Fetch the customer data
    $query = "SELECT * FROM `customers` WHERE `ID` = '$ID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
        // Check if a row was returned
        if (!$row) {
            die("No customer found with ID: $ID");
        }
    }
}

if (isset($_POST['updateCustomer'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $birthDate = $_POST['birthDate'];
    $contactNumber = $_POST['contactNumber'];
    $emailAddress = $_POST['emailAddress'];

    // Update the customer data
    $query = "UPDATE `customers` SET `firstName` = '$firstName', `lastName` = '$lastName', `middleName` = '$middleName', `birthDate` = '$birthDate', `contactNumber` = '$contactNumber', `emailAddress` = '$emailAddress' WHERE `ID` = '$ID'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo'<script> alert("Costumer Updated failed.'. mysqli_error($connection). '");window.location.href="../customer.php"</script>';
    } else {
        echo"<script>alert('Customer Updated successfully'); window.location.href='../customer.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Update Customer</h1>
    <form action="update_page_1.php?ID=<?php echo $ID; ?>" method="post">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" class="form-control" value="<?php echo isset($row['firstName']) ? htmlspecialchars($row['firstName']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" class="form-control" value="<?php echo isset($row['lastName']) ? htmlspecialchars($row['lastName']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="middleName">Middle Name</label>
            <input type="text" name="middleName" class="form-control" value="<?php echo isset($row['middleName']) ? htmlspecialchars($row['middleName']) : ''; ?>">
        </div>
        <div class="form-group">
            <label for="birthDate">Birth Date</label>
            <input type="date" name="birthDate" class="form-control" value="<?php echo isset($row['birthDate']) ? htmlspecialchars($row['birthDate']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="contactNumber">Contact Number</label>
            <input type="text" name="contactNumber" class="form-control" value="<?php echo isset($row['contactNumber']) ? htmlspecialchars($row['contactNumber']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="emailAddress">Email Address</label>
            <input type="email" name="emailAddress" class="form-control" value="<?php echo isset($row['emailAddress']) ? htmlspecialchars($row['emailAddress']) : ''; ?>" required>
        </div>

        <input type="submit" class="btn btn-primary" name="updateCustomer" value="Update Customer">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>