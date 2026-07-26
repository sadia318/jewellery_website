<?php
include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id = $_GET['id'];

$order = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM orders WHERE order_id='$id'"));

if(isset($_POST['update'])){

    $status = $_POST['status'];

    mysqli_query($conn,"
    UPDATE orders
    SET order_status='$status'
    WHERE order_id='$id'
    ");

    header("Location: orders.php");
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

<h4>Update Order Status</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Invoice Number</label>

<input
type="text"
class="form-control"
value="<?php echo $order['invoice_number']; ?>"
readonly>

</div>

<div class="mb-3">

<label>Current Status</label>

<select
name="status"
class="form-control">

<option value="Pending"
<?php if($order['order_status']=="Pending") echo "selected"; ?>>

Pending

</option>

<option value="Processing"
<?php if($order['order_status']=="Processing") echo "selected"; ?>>

Processing

</option>

<option value="Delivered"
<?php if($order['order_status']=="Delivered") echo "selected"; ?>>

Delivered

</option>

</select>

</div>

<button
class="btn btn-success"
name="update">

Update Status

</button>

<a
href="orders.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>