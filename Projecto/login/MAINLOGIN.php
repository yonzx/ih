<?php
$host = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "loyalty_system";

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$username = "";
$password = "";
$username_error = "";
$password_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    if (empty($username_error) && empty($password_error)) {
        $sql = "SELECT * FROM loginn WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                header("Location: ../index.php");
                exit();
            } else {
                $password_error = "Invalid password";
            }
        } else {
            $username_error = "Invalid username";
        }
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
    <title>Log-in</title>
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
            <header>Login</header>
            <form method="post" action="">
                <div class="field input">
                    <input type="text" name="username" value="<?php if(isset($username)) echo $username; ?>" placeholder="Username">
                    <span class="error" style="color: red;"><?php if(isset($username_error)) echo $username_error; ?></span>
                </div>

                <div class="field input">
                    <input type="password" name="password" value="<?php if(isset($password)) echo $password; ?>" placeholder="Password">
                    <span class="error" style="color: red;"><?php if(isset($password_error)) echo $password_error; ?></span>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Log In">
                </div>
 
                <div class="links text-center mt-3">
                    <p>Don't have an account?
                    <a href="indexx.php">Register</a></p>
                </div>
            </form>
        </div> 
    </div>

</body>
</html>
