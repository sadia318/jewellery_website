<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM brands WHERE brand_id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $brand=mysqli_real_escape_string($conn,$_POST['brand']);

    mysqli_query($conn,"UPDATE brands SET brand_title='$brand' WHERE brand_id='$id'");

    header("Location: brands.php");
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<div class="card shadow">

<div class="card-header">

<h4>Edit Brand</h4>

</div>

<div class="card-body">

<form method="POST">

<input
type="text"
name="brand"
class="form-control mb-3"
value="<?php echo $row['brand_title']; ?>"
required>

<button
class="btn btn-success"
name="update">

Update Brand

</button>

<a href="brands.php" class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>