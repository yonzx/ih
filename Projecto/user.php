<?php
include("user/data.php");
include("user/delete.php");  
include("header.php");    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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
                <h4 class="mb-0">Users</h4>
                <div class="box1">
                    <button type="button" class="btn btn-light p-1 m-1" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-plus-lg"></i></button>
                </div>
            </div>
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search..." id="searchInput">
            </div>
        </div>
            
        <div class="table-responsive position-absolute top--3 start-0">
            <h2>Active Users</h2>
            <table class="table" id="userTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
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
                        $query = "SELECT * FROM loginn WHERE isDeleted = 0";
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query Failed: " . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['fname'];?></td>
                            <td><?php echo $row['branchid']; ?></td>
                            <td><?php echo $row['createdBy']; ?></td>
                            <td><?php echo $row['createdDate']; ?></td>
                            <td><?php echo $row['updatedBy']; ?></td>
                            <td><?php echo $row['updatedDate']; ?></td>
                            <td><a href="user/update_user.php?ID=<?php echo $row['ID']; ?>" class="btn btn-success">Update</a></td>
                            <td>
                                <form action="user/delete.php" method="get">
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
        <h2 style="margin-top: 50px;">Deleted Users</h2>
            <table class="table" id="userTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Branch ID</th>
                        <th>Deleted By</th>
                        <th>Deleted Date</th>
                        <th>Restore</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM loginn WHERE isDeleted = 1";
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query Failed: " . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['fname'];?></td>
                            <td><?php echo $row['branchid']; ?></td>
                            <td><?php echo $row['deletedBy'];?></td>
                            <td><?php echo $row['createdBy']; ?></td>
                            <td><?php echo $row['createdDate']; ?></td>
                            <td>
                                <a href="user/restore_page.php?ID=<?php echo $row['ID']; ?>" class="btn btn-info">Restore</a>
                            </td>

                        </tr>
                    <?php
                    }
                }
            ?>
                </tbody>
            </table>
        </div>

    <!-- Modal for Adding a User -->
    <form action="user/insert_data.php" method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" name="id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="Firstname">First Name</label>
                            <input type="text" name="Firstname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="BranchID">Branch ID</label>
                            <input type="BranchID" name="BranchID" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="addUser" value="Add User">
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