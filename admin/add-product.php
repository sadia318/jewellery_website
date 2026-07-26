<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$message="";

if(isset($_POST['add_product'])){

    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $description=mysqli_real_escape_string($conn,$_POST['description']);
    $category=$_POST['category'];
    $brand=$_POST['brand'];
    $price=$_POST['price'];
    $stock=$_POST['stock'];

    $image=$_FILES['image']['name'];
    $tmp=$_FILES['image']['tmp_name'];

    move_uploaded_file($tmp,"uploads/".$image);

    mysqli_query($conn,"INSERT INTO products
    (product_title,product_description,category_id,brand_id,product_price,product_image,product_stock)

    VALUES

    ('$title','$description','$category','$brand','$price','$image','$stock')");

    $message="<div class='alert alert-success'>
    Product Added Successfully.
    </div>";
}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<h2>Add Product</h2>

<?php echo $message; ?>

<form method="POST" enctype="multipart/form-data">

<div class="card shadow p-4">

<div class="mb-3">

<label>Product Name</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="4"></textarea>

</div>

<div class="mb-3">

<label>Category</label>

<select
name="category"
class="form-control">

<?php

$result=mysqli_query($conn,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($result)){

?>

<option value="<?php echo $row['category_id']; ?>">

<?php echo $row['category_title']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Brand</label>

<select
name="brand"
class="form-control">

<?php

$result=mysqli_query($conn,"SELECT * FROM brands");

while($row=mysqli_fetch_assoc($result)){

?>

<option value="<?php echo $row['brand_id']; ?>">

<?php echo $row['brand_title']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Price</label>

<input
type="number"
name="price"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Stock</label>

<input
type="number"
name="stock"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Product Image</label>

<input
type="file"
name="image"
class="form-control"
required>

</div>

<button
class="btn btn-success"
name="add_product">

Add Product

</button>

</div>

</form>

</div>

<?php include("includes/footer.php"); ?>