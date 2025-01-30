<?php
include("data.php");

// Initialize $row to avoid undefined variable notice
$row = null; 

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    // Fetch the customer data
    $query = "SELECT * FROM `loginn` WHERE `ID` = '$ID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
        // Check if a row was returned
        if (!$row) {
            die("No user found with ID: $ID");
        }
    }
}

if (isset($_POST['updateUser'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $branchid = $_POST['branchid'];

    // Update the customer data
    $query = "UPDATE `loginn` SET `fname` = '$fname', `lname` = '$lname', `mname` = '$mname', `branchid` = '$branchid' WHERE `ID` = '$ID'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo'<script> alert("User Updated failed.'. mysqli_error($connection). '");window.location.href="../user.php"</script>';
    } else {
        echo"<script>alert('User Updated successfully'); window.location.href='../user.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Update User</h1>
    <form action="update_user.php?ID=<?php echo $ID; ?>" method="post">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" class="form-control" value="<?php echo isset($row['fname']) ? htmlspecialchars($row['fname']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" class="form-control" value="<?php echo isset($row['lname']) ? htmlspecialchars($row['lname']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="middleName">Middle Name</label>
            <input type="text" name="middleName" class="form-control" value="<?php echo isset($row['mname']) ? htmlspecialchars($row['mname']) : ''; ?>">
        </div>
        <div class="form-group">
            <label for="branchid">Branch Id</label>
            <input type="number" name="branchid" class="form-control" value="<?php echo isset($row['branchid']) ? htmlspecialchars($row['branchid']) : ''; ?>" required>
        </div>

        <input type="submit" class="btn btn-primary" name="updateUser" value="Update User">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>