<?php
    include('data.php');

    if(isset($_GET['ID'])){
        $ID = $_GET['ID'];

    $query = "UPDATE loginn SET isDeleted = 0 WHERE ID = '$ID'";

    $result = mysqli_query($connection, $query);

    if(!$result){
        echo'<script> alert("Customer restored successfully.'. mysqli_error($connection). '");window.location.href="../user.php"</script>';
        
    }

    else{
        echo"<script>alert('Customer restored successfully.'); window.location.href='../user.php'</script>";
    }

    }
?>