<?php
include('data.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $customerId = $_POST['customerId'];
    $branchId = $_POST['branchId'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $updatedBy = $_POST['updatedBy']; // Get the updatedBy value

    // Prepare the SQL statement
    $sql = "UPDATE visit SET customerId=?, branchId=?, date=?, time=?, updatedBy=? WHERE id=?";
    
    // Prepare and bind
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssi", $customerId, $branchId, $date, $time, $updatedBy, $id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or display success message
            header("Location: ../visit.php?update=success");
        } else {
            // Handle error
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
    } else {
        // Handle error
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>