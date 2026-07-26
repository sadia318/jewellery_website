<?php
include("includes/connect.php");
include("includes/header.php");
include("includes/navbar.php");

$total = isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : 0;
?>

<div class="container my-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>Payment</h3>

</div>

<div class="card-body">

<h4 class="mb-4">
Grand Total :
<span class="text-danger">৳<?php echo number_format($total); ?></span>
</h4>

<form action="" method="POST">

<div class="mb-3">
<label class="form-label">Select Payment Method</label>

<select name="payment_method" class="form-control" required>

<option value="">Choose Payment</option>

<option value="Cash On Delivery">Cash On Delivery</option>

<option value="bKash">bKash</option>

<option value="Nagad">Nagad</option>

<option value="Rocket">Rocket</option>

<option value="Bank Transfer">Bank Transfer</option>

</select>

</div>

<button type="submit" name="confirm" class="btn btn-success w-100">

Confirm Order

</button>

</form>

<?php

if(isset($_POST['confirm'])){

    $payment = $_POST['payment_method'];

    echo "<div class='alert alert-success mt-3'>
    <h5>Order Confirmed Successfully!</h5>
    <p><strong>Payment Method:</strong> $payment</p>
    <p><strong>Total:</strong> ৳".number_format($total)."</p>
    </div>";

    // চাইলে পরে এখানে Database INSERT যোগ করা যাবে।
}
?>

</div>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>