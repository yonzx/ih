<?php
include("customer/dbcon.php");
include("customer/delete_page.php");  
include("header.php");          
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include("sidemenu.php")?>
<div id="content" class="position-absolute top-0 start-0">
    <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <h4 class="mb-0">Customers</h4>
                <div class="box1">
                    <button type="button" class="btn btn-light p-1 m-1" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-plus-lg"></i></button>
                </div>
            </div>
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search..." id="searchInput">
            </div>
        </div>
            
        <div class="table-responsive position-absolute top--3 start-0">
            <h2>Active Customers</h2>
            <table class="table" id="customerTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Birth Date</th>
                        <th>Contact Number</th>
                        <th>Email Address</th>
                        <th>Branch ID</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Updated By</th>
                        <th>Updated Date</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM customers WHERE isDeleted = 0";
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query Failed: " . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['firstName'].' '.$row['middleName'].' '.$row['lastName']?></td>
                            <td><?php echo $row['birthDate']; ?></td>
                            <td><?php echo $row['contactNumber']; ?></td>
                            <td><?php echo $row['emailAddress']; ?></td>
                            <td><?php echo $row['BranchID']; ?></td>
                            <td><?php echo $row['createdBy']; ?></td>
                            <td><?php echo $row['createdDate']; ?></td>
                            <td><?php echo $row['updatedBy']; ?></td>
                            <td><?php echo $row['updatedDate']; ?></td>
                            <td><a href="customer/update_page_1.php?ID=<?php echo $row['ID']; ?>" class="btn btn-success">Update</a></td>
                            <td>
                                <form action="customer/delete_page.php" method="get">
                                    <input type="hidden" name="ID" value='<?php echo $row['ID']; ?>'>
                                    <button type='submit' class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                }
            ?>
                </tbody>
            </table>
        <h2 style="margin-top: 50px;">Deleted Customers</h2>
            <table class="table" id="customerTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Birth Date</th>
                        <th>Contact Number</th>
                        <th>Email Address</th>
                        <th>Branch ID</th>
                        <th>Deleted By</th>
                        <th>Deleted Date</th>
                        <th>Restore</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM customers WHERE isDeleted = 1";
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query Failed: " . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['firstName'].' '.$row['middleName'].' '.$row['lastName']?></td>
                            <td><?php echo $row['birthDate']; ?></td>
                            <td><?php echo $row['contactNumber']; ?></td>
                            <td><?php echo $row['emailAddress']; ?></td>
                            <td><?php echo $row['BranchID']; ?></td>
                            <td><?php echo $row['createdBy']; ?></td>
                            <td><?php echo $row['createdDate']; ?></td>
                            <td>
                                <a href="customer/restore_page.php?ID=<?php echo $row['ID']; ?>" class="btn btn-info">Restore</a>
                            </td>

                        </tr>
                    <?php
                    }
                }
            ?>
                </tbody>
            </table>
        </div>

    <!-- Modal for Adding a Customer -->
    <form action="customer/insert_data.php" method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" name="middleName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="birthDate">Birth Date</label>
                            <input type="date" name="birthDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="text" name="contactNumber" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Email Address</label>
                            <input type="email" name="emailAddress" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="BranchID">Branch ID</label>
                            <input type="BranchID" name="BranchID" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="addCustomer" value="Add Customer">
                    </div>
                </div>
            </div>
        </div>
    </form>
<div class="text-end">
    <button id="themeToggle" class="btn btn-primary rounded-circle"><i class="mode-icon">🌙</i></button>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<?php include("footer.php");
?>
</body>
</html>