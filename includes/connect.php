<?php

$conn = mysqli_connect("localhost", "root", "", "jewellery_shop");

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>