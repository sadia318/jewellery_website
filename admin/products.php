<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<h2 class="mb-4">All Products</h2>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Image</th>

<th>Product</th>

<th>Category</th>

<th>Brand</th>

<th>Price</th>

<th>Stock</th>

<th width="160">Action</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($conn,"
SELECT
products.*,
categories.category_title,
brands.brand_title

FROM products

INNER JOIN categories
ON products.category_id=categories.category_id

INNER JOIN brands
ON products.brand_id=brands.brand_id

ORDER BY product_id DESC
");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?php echo $row['product_id']; ?></td>

<td>

<img
src="uploads/<?php echo $row['product_image'];?>"
width="70"
height="70"
style="object-fit:cover;">

</td>

<td>

<?php echo $row['product_title']; ?>

</td>

<td>

<?php echo $row['category_title']; ?>

</td>

<td>

<?php echo $row['brand_title']; ?>

</td>

<td>

৳<?php echo $row['product_price']; ?>

</td>

<td>

<?php echo $row['product_stock']; ?>

</td>

<td>

<a
href="edit-product.php?id=<?php echo $row['product_id'];?>"
class="btn btn-primary btn-sm">

Edit

</a>

<a
href="delete-product.php?id=<?php echo $row['product_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Product?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<?php
include("includes/footer.php");
?>