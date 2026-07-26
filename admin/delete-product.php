<?php

include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id = $_GET['id'];

$product = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM products WHERE product_id='$id'"));

if(file_exists("uploads/".$product['product_image'])){
    unlink("uploads/".$product['product_image']);
}

mysqli_query($conn,"DELETE FROM products WHERE product_id='$id'");

header("Location: products.php");

exit();

?>