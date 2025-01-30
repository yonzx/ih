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

    $errors=[];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup']))
    {
        $fname=$_POST['firstname'];
        $lname=$_POST['lastname'];
        $mname=$_POST['middlename'];
        $connum=$_POST['connum'];
        $email=$_POST['email'];
        $username=$_POST['username'];
        $password=$_POST['password'];

        if(empty($username))
        {
            $errors['username']="Username is required";
        }

        if(strlen($username))
        {
            $errors['password']="Password must be at least 8 characters long.";
        }

        $stmt = $pdo->prepare("SELECT * FROM loginn WHERE username = :username");
        $stmt->execute([':username' => $username]);

        if ($stmt->fetch())   
        {
            $errors['username_exist']="Username Already Exist";
        }


        if (!empty($errors))   
        {
            $_SESSION['errors']=$errors;
            header('Location: MAINLOGIN.php');
            exit();
        }

        $sql = "INSERT INTO `data` (`name`, `password`, `email`) VALUES ('$username', '$hashed_password', '$email')";

        header('Location: MAINLOGIN.php');
            exit();

    }

        
?>