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

<h2 class="mb-4">Order Management</h2>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Customer</th>
<th>Invoice</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($conn,"
SELECT
orders.*,
users.username

FROM orders

INNER JOIN users
ON orders.user_id=users.user_id

ORDER BY order_id DESC
");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?php echo $row['order_id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['invoice_number']; ?></td>

<td>৳<?php echo $row['total_amount']; ?></td>

<td><?php echo $row['payment_method']; ?></td>

<td>

<?php

if($row['order_status']=="Pending"){

echo "<span class='badge bg-warning'>Pending</span>";

}elseif($row['order_status']=="Processing"){

echo "<span class='badge bg-primary'>Processing</span>";

}else{

echo "<span class='badge bg-success'>Delivered</span>";

}

?>

</td>

<td><?php echo $row['order_date']; ?></td>

<td>

<a
href="update-order.php?id=<?php echo $row['order_id'];?>"
class="btn btn-success btn-sm">

Update

</a>

<a
href="delete-order.php?id=<?php echo $row['order_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Order?')">

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