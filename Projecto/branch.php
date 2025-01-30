<?php
include("branch/data.php");
include("branch/delete_page_branch.php");  
include("header.php");          
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch</title>
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
                <h4 class="mb-0">Branch</h4>
                <div class="box1">
                    <button type="button" class="btn btn-light p-1 m-1" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-lg"></i></button>
                </div>
            </div>
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search..." id="searchInput">
            </div>
        </div>
            
        <div class="table-responsive position-absolute top--3 start-0">
            <h2>Active Branch</h2>
            <table class="table" id="customerTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>zip</th>
                        <th>Email Address</th>
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
                        $query = "SELECT * FROM branch WHERE isDeleted = 0";
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query Failed: " . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                        <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['zip']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['createdBy']; ?></td>
                            <td><?php echo $row['createDate']; ?></td>
                            <td><?php echo $row['updatedBy']; ?></td>
                            <td><?php echo $row['updateDate']; ?></td>
                            <td><a href="/branch/update_page_branch.php?ID=<?php echo $row['ID']; ?>" class="btn btn-success">Update</a></td>
                            <td>
                                <form action="branch/delete_page_branch.php" method="get">
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
        <h2 style="margin-top: 50px;">Deleted Branch</h2>
            <table class="table" id="customerTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>zip</th>
                        <th>Email Address</th>
                        <th>Restore</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM branch WHERE isDeleted = 1";
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query Failed: " . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['zip']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="branch/restore_page_branch.php?ID=<?php echo $row['ID']; ?>" class="btn btn-info">Restore</a>
                        </td>

                        </tr>
                    <?php
                    }
                }
            ?>
                </tbody>
            </table>
        </div>

    <!-- Modal for Adding a Branch -->
    <form action="branch/insert_data_branch.php" method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a Branch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div> 
                        <div class="form-group"> <label for="createdBy">Created By</label>
                        <input type="text" name="createdBy" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="contactNumber">Contact Number</label>
                        <input type="text" name="contact" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group"> <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="form-group"> <label for="zip">Zip</label>
                <input type="text" name="zip" class="form-control" required>
            </div>
            
        </div>
        <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <input type="submit" class="btn btn-primary" name="addBranch" value="Add Branch"> </div>
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