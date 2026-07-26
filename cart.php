<?php

include("includes/connect.php");
include("includes/header.php");
include("includes/navbar.php");



// Update Quantity
if(isset($_POST['update_cart'])){

    foreach($_POST['qty'] as $product_id=>$quantity){

        $quantity=(int)$quantity;

        if($quantity<=0){
            unset($_SESSION['cart'][$product_id]);
        }else{
            $_SESSION['cart'][$product_id]=$quantity;
        }

    }

    header("Location: cart.php");
    exit();
}

// Remove Product
if(isset($_GET['remove'])){

    $product_id=(int)$_GET['remove'];

    unset($_SESSION['cart'][$product_id]);

    header("Location: cart.php");
    exit();
}


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

/* Add Product */
if(isset($_GET['add'])){

    $product_id = (int)$_GET['add'];

    if(isset($_SESSION['cart'][$product_id])){
        $_SESSION['cart'][$product_id]++;
    }else{
        $_SESSION['cart'][$product_id]=1;
    }

    header("Location: cart.php");
    exit();
}
?>

<div class="container my-5">

<h2 class="mb-4">Shopping Cart</h2>

<form>
<table class="table table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>


</tr>

</thead>

<tbody>

<?php

$total=0;

foreach($_SESSION['cart'] as $product_id=>$qty){

$query="SELECT * FROM products WHERE product_id=$product_id";
$result=mysqli_query($conn,$query);
$product=mysqli_fetch_assoc($result);

$sub_total=$product['product_price']*$qty;

$total+=$sub_total;

?>

<tr>

<td width="120">
<img src="assets/images/products/<?php echo $product['product_image1']; ?>" width="80">
</td>

<td><?php echo $product['product_title']; ?></td>

<td>৳<?php echo number_format($product['product_price']); ?></td>

<td width="120">

<input
type="number"
name="qty[<?php echo $product_id; ?>]"
class="form-control"
value="<?php echo $qty; ?>"
min="1">

</td>



<td>৳<?php echo number_format($sub_total); ?></td>

</tr>

<td>

<a href="cart.php?remove=<?php echo $product_id; ?>"
class="btn btn-danger btn-sm">

<i class="fa fa-trash"></i>

Remove

</a>

</td>



<?php } ?>

</tbody>

</table>

<div class="d-flex justify-content-between mt-4">

<a href="index.php"
class="btn btn-outline-dark">

Continue Shopping

</a>

<div>

<button
type="submit"
name="update_cart"
class="btn btn-warning">

Update Cart

</button>

<a href="checkout.php"
class="btn btn-custom">

Checkout

</a>
<a href="checkout.php" class="btn btn-success">
    Proceed To Checkout
</a>

</div>

</div>

</form>

<h3 class="text-end">

Grand Total :
<span class="text-danger">
৳<?php echo number_format($total); ?>
</span>

</h3>

</div>

<?php
$_SESSION['cart_total']=$total;

include("includes/footer.php");
?>