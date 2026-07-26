<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM categories WHERE category_id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $category = mysqli_real_escape_string($conn,$_POST['category']);

    mysqli_query($conn,"UPDATE categories
    SET category_title='$category'
    WHERE category_id='$id'");

    header("Location: categories.php");
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<div class="container">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>Edit Category</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Category Name</label>

<input
type="text"
name="category"
class="form-control"
value="<?php echo $row['category_title']; ?>"
required>

</div>

<button
class="btn btn-success"
name="update">

Update Category

</button>

<a href="categories.php" class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>