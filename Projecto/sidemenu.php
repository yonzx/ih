<?php
session_start();
// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: MAINLOGIN.php"); // Redirect to the login page
    exit();
}
?>

<?php include('header.php'); ?>
<div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
            <a class="navbar-brand" href="../index.php">
                    <img src="../src/Sb.png" alt="Logo" class="logo">
                <h3><a class="mb-4 text-decoration-none text-light fs-5" href="../index.php">Bituin na likod</a></h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#maintenanceSubmenu" data-bs-toggle="collapse" class="dropdown-toggle">
                        <i class="bi bi-gear"></i> Maintenance
                    </a>
                    <ul class="collapse list-unstyled" id="maintenanceSubmenu">
                        <li>
                            <a href="customer.php"><i class="bi bi-people"></i> Customers</a>
                        </li>
                        <li>
                            <a href="branch.php"><i class="bi bi-building"></i> Branch</a>
                        </li>
                        <li>
                            <a href="user.php"><i class="bi bi-person"></i> Users</a>
                        </li>
                        <li>
                            <a href="visit.php"><i class="bi bi-person-walking"></i> Customer Visits</a>
                        </li>
                    </ul>
                </li>
                <div class="text-start">
                    <h3><a class="logout fs-6 text-decoration-none m-1 position-absolute bottom-0 start-0 bi bi-box-arrow-left" href="login/logout.php"> Log out</a></h3>
                </div>
            </ul>
        </nav>