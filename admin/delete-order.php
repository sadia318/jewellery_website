<?php

include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn,"
DELETE FROM orders
WHERE order_id='$id'
");

header("Location:orders.php");

exit();
?>