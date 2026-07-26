<?php

include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id=$_GET['id'];

mysqli_query($conn,"
DELETE FROM users
WHERE user_id='$id'
");

header("Location:users.php");

exit();

?>