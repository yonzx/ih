<?php
session_start();

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirect to the homepage or dashboard
    exit();
}

$fname= "";
$lname= "";
$mname= "";
$connum= "";
$email= "";
$username = "";
$password = "";
$branchid = "";
$fname_error= "";
$lname_error= "";
$mname_error= "";
$connum_error= "";
$email_error= "";
$username_error = "";
$password_error = "";
$branchid_error = "";

$host="localhost";
$username_db="root";
$password_db="";
$dbname="loyalty_system";

$pdo=new PDO("mysql:host=$host;dbname=$dbname",$username_db,$password_db);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fname"])) {
        $fname_error = "First Name is required";
    } else {
        $fname = test_input($_POST["fname"]);
    }

    if (empty($_POST["lname"])) {
        $lname_error = "Last Name is required";
    } else {
        $lname = test_input($_POST["lname"]);
    }

    if (empty($_POST["mname"])) {
        $mname_error = "Middle Name is required";
    } else {
        $mname = test_input($_POST["mname"]);
    }

    if (empty($_POST["connum"])) {
        $connum_error = "Contact Number is required";
    } else {
        $connum = test_input($_POST["connum"]);
    }

    if (empty($_POST["email"])) {
        $email_error = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["username"])) {
        $username_error = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $password_error = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["branchid"])) {
        $branchid_error = "Branch ID is required";
    } else {
        $branchid = test_input($_POST["branchid"]);
    }

    if(empty($fname_error) && empty($lname_error) && empty($mname_error) && empty($connum_error) && empty($email_error) && empty($username_error) && empty($password_error) && empty($branchid_error)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO loginn (fname, lname, mname, connum, email, username, password, branchid) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fname, $lname, $mname, $connum, $email, $username, $hashed_password, $branchid]);

        header("Location: MAINLOGIN.php");
        exit();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container">
    <div class="box form-box">
        <header>Register</header>

        <form method="post" action="">

            <div class="field input">
                <input type="text" class="p-2" name="fname" value="<?php echo $fname; ?>" placeholder="First Name">
                <span class="error" style="color: red;"><?php echo $fname_error; ?></span>
            </div>

            <div class="field input">
                <input type="text" class="p-2" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name">
                <span class="error" style="color: red;"><?php echo $lname_error; ?></span>
            </div>

            <div class="field input">
                <input type="text" class="p-2" name="mname" value="<?php echo $mname; ?>" placeholder="Middle Name">
                <span class="error" style="color: red;"><?php echo $mname_error; ?></span>
            </div>

            <div class="field input">
                <input type="text" class="p-2" name="connum" value="<?php echo $connum; ?>" placeholder="Contact Number">
                <span class="error" style="color: red;"><?php echo $connum_error; ?></span>
            </div>

            <div class="field input">
                <input type="text" class="p-2" name="email" value="<?php echo $email; ?>" placeholder="Email">
                <span class="error" style="color: red;"><?php echo $email_error; ?></span>
            </div>

            <div class="field input">
                <input type="text" class="p-2" name="username" value="<?php echo $username; ?>" placeholder="Username">
                <span class="error" style="color: red;"><?php echo $username_error; ?></span>
            </div>

            <div class="field input">
                <input type="password" class="p-2" name="password" value="<?php echo $password; ?>" placeholder="Password">
                <span class="error" style="color: red;"><?php echo $password_error; ?></span>
            </div>

            <div class="field input">
                <select class="form-select mt-2 p-2" name="branchid" >
                    <option value="" disabled selected>Select your Branch ID</option>
                    <option value="1" <?php echo ($branchid == "1") ? 'selected' : ''; ?>>1. Commonwealth</option>
                    <option value="2" <?php echo ($branchid == "2") ? 'selected' : ''; ?>>2. Tandang Sora</option>

                </select>
                <span class="error" style="color: red;"><?php echo $branchid_error; ?></span>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="signup" value="Register">
            </div>

            <div class="links text-center mt-3">
                <p>Already have an account? <a href="MAINLOGIN.php">Login</a></p>
            </div>

        </form>

    </div>
</div>
</body>
</html>
