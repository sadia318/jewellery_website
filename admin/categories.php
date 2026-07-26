<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$message="";

if(isset($_POST['add_category'])){

    $category = mysqli_real_escape_string($conn,$_POST['category_name']);

    $check = mysqli_query($conn,"SELECT * FROM categories WHERE category_title='$category'");

    if(mysqli_num_rows($check)>0){

        $message="<div class='alert alert-warning'>
        Category Already Exists.
        </div>";

    }else{

        mysqli_query($conn,"INSERT INTO categories(category_title) VALUES('$category')");

        $message="<div class='alert alert-success'>
        Category Added Successfully.
        </div>";

    }

}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<h2 class="mb-4">Category Management</h2>

<?php echo $message; ?>

<div class="card shadow">

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="category_name"
class="form-control"
placeholder="Enter Category Name"
required>

</div>

<div class="col-md-2">

<button
class="btn btn-success w-100"
name="add_category">

Add

</button>

</div>

</div>

</form>

</div>

</div>

<br>

<div class="card shadow">

<div class="card-header">

<h4>All Categories</h4>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>

<th>Category</th>

<th width="180">Action</th>

</tr>

</thead>

<tbody>

<?php

$result=mysqli_query($conn,"SELECT * FROM categories ORDER BY category_id DESC");

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['category_id']; ?></td>

<td><?php echo $row['category_title']; ?></td>

<td>

<a href="edit-category.php?id=<?php echo $row['category_id']; ?>"
class="btn btn-primary btn-sm">

Edit

</a>

<a href="delete-category.php?id=<?php echo $row['category_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this category?')">

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

<?php include("includes/footer.php"); ?>