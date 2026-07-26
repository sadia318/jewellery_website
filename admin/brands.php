<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$message="";

if(isset($_POST['add_brand'])){

    $brand=mysqli_real_escape_string($conn,$_POST['brand_name']);

    $check=mysqli_query($conn,"SELECT * FROM brands WHERE brand_title='$brand'");

    if(mysqli_num_rows($check)>0){

        $message="<div class='alert alert-warning'>Brand Already Exists</div>";

    }else{

        mysqli_query($conn,"INSERT INTO brands(brand_title) VALUES('$brand')");

        $message="<div class='alert alert-success'>Brand Added Successfully</div>";

    }

}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<h2>Brand Management</h2>

<?php echo $message; ?>

<div class="card shadow mb-4">

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="brand_name"
class="form-control"
placeholder="Enter Brand Name"
required>

</div>

<div class="col-md-2">

<button
class="btn btn-success w-100"
name="add_brand">

Add

</button>

</div>

</div>

</form>

</div>

</div>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered">

<tr>

<th>ID</th>

<th>Brand</th>

<th>Action</th>

</tr>

<?php

$result=mysqli_query($conn,"SELECT * FROM brands ORDER BY brand_id DESC");

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['brand_id']; ?></td>

<td><?php echo $row['brand_title']; ?></td>

<td>

<a href="edit-brand.php?id=<?php echo $row['brand_id']; ?>" class="btn btn-primary btn-sm">

Edit

</a>

<a href="delete-brand.php?id=<?php echo $row['brand_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this Brand?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>