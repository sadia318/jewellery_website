<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id = $_GET['id'];

$product = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM products WHERE product_id='$id'"));

if(isset($_POST['update_product'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $image = $product['product_image'];

    if($_FILES['image']['name']!=""){

        $image = $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "uploads/".$image
        );
    }

    mysqli_query($conn,"UPDATE products SET

    product_title='$title',
    product_description='$description',
    category_id='$category',
    brand_id='$brand',
    product_price='$price',
    product_stock='$stock',
    product_image='$image'

    WHERE product_id='$id'
    ");

    header("Location: products.php");
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">

<div class="card shadow p-4">

<div class="mb-3">

<label>Product Name</label>

<input
type="text"
name="title"
class="form-control"
value="<?php echo $product['product_title']; ?>"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="4"><?php echo $product['product_description']; ?></textarea>

</div>

<div class="mb-3">

<label>Category</label>

<select name="category" class="form-control">

<?php

$cat=mysqli_query($conn,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($cat)){

?>

<option
value="<?php echo $row['category_id']; ?>"

<?php

if($product['category_id']==$row['category_id']) echo "selected";

?>

>

<?php echo $row['category_title']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Brand</label>

<select name="brand" class="form-control">

<?php

$brand=mysqli_query($conn,"SELECT * FROM brands");

while($row=mysqli_fetch_assoc($brand)){

?>

<option
value="<?php echo $row['brand_id']; ?>"

<?php

if($product['brand_id']==$row['brand_id']) echo "selected";

?>

>

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
value="<?php echo $product['product_price']; ?>"
required>

</div>

<div class="mb-3">

<label>Stock</label>

<input
type="number"
name="stock"
class="form-control"
value="<?php echo $product['product_stock']; ?>"
required>

</div>

<div class="mb-3">

<label>Current Image</label><br>

<img
src="uploads/<?php echo $product['product_image']; ?>"
width="120">

</div>

<div class="mb-3">

<label>Change Image</label>

<input
type="file"
name="image"
class="form-control">

</div>

<button
class="btn btn-success"
name="update_product">

Update Product

</button>

<a
href="products.php"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

<?php include("includes/footer.php"); ?>