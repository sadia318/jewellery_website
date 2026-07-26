<?php
include("includes/connect.php");
include("includes/functions.php");
include("includes/header.php");
include("includes/navbar.php");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$product_id = (int)$_GET['id'];

$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='container py-5'><h3>Product Not Found!</h3></div>";
    include("includes/footer.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<div class="container my-5">
    <div class="row">

        <!-- Product Image -->
        <div class="col-md-6">
            <img src="assets/images/products/<?php echo $row['product_image1']; ?>"
                 class="img-fluid rounded shadow"
                 alt="<?php echo $row['product_title']; ?>">
        </div>

        <!-- Product Info -->
        <div class="col-md-6">

            <h2 class="mb-3">
                <?php echo $row['product_title']; ?>
            </h2>

            <h3 class="text-custom-maroon mb-3">
                ৳<?php echo number_format($row['product_price']); ?>
            </h3>

            <p>
                <?php echo $row['product_description']; ?>
            </p>

            <p>
                <strong>Stock :</strong>
                <?php
                if ($row['product_stock'] > 0) {
                    echo "<span class='text-success'>In Stock</span>";
                } else {
                    echo "<span class='text-danger'>Out of Stock</span>";
                }
                ?>
            </p>

            <a href="cart.php?add=<?php echo $row['product_id']; ?>" class="btn btn-custom">
                <i class="fas fa-cart-plus"></i> Add To Cart
            </a>

            <a href="index.php" class="btn btn-outline-dark">
                Continue Shopping
            </a>

        </div>

    </div>
</div>

<?php
include("includes/footer.php");
?>