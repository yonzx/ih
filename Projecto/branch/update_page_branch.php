<?php
include("data.php");

// Initialize $row to avoid undefined variable notice
$row = null; 

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    // Fetch the Branch data
    $query = "SELECT * FROM `branch` WHERE `ID` = '$ID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
        // Check if a row was returned
        if (!$row) {
            die("No Branch found with ID: $ID");
        }
    }
}

if (isset($_POST['updateBranch'])) {
    $$name = $_POST['Name'];
    $contactNumber = $_POST['ContactNumber'];
    $address = $_POST['Address'];
    $zip = $_POST['Zip'];
    $emailAddress = $_POST['EmailAddress'];

    // Update the customer data
    $query = "UPDATE `customers` SET `Name` = '$name', `ContactNumber` = '$contactNumber', `Address` = '$address', `Zip` = '$zip', `EmailAddress` = '$emailAddress' WHERE `ID` = '$ID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo'<script> alert("Costumer Updated failed.'. mysqli_error($connection). '");window.location.href="../branch.php"</script>';
    } else {
        echo"<script>alert('Customer Updated successfully'); window.location.href='../branch.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Branch</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Update Branch</h1>
    <form action="update_page_1.php?ID=<?php echo $ID; ?>" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="Name" class="form-control" value="<?php echo isset($row['Name']) ? htmlspecialchars($row['Name']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="createdBy">Created By</label>
            <input type="text" name="CreatedBy" class="form-control" value="<?php echo isset($row['CreatedBy']) ? htmlspecialchars($row['CreatedBy']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="contactNumber">Contact Number</label>
            <input type="text" name="ContactNumber" class="form-control" value="<?php echo isset($row['ContactNumber']) ? htmlspecialchars($row['ContactNumber']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="emailAddress">Email Address</label>
            <input type="email" name="EmailAddress" class="form-control" value="<?php echo isset($row['EmailAddress']) ? htmlspecialchars($row['EmailAddress']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="Address" class="form-control" value="<?php echo isset($row['Address']) ? htmlspecialchars($row['Address']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="zip">Zip</label>
            <input type="text" name="Zip" class="form-control" value="<?php echo isset($row['Zip']) ? htmlspecialchars($row['Zip']) : ''; ?>" required>
        </div>

        <input type="submit" class="btn btn-primary" name="updateCustomer" value="Update Customer">
    </form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>