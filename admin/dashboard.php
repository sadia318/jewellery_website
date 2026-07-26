<?php

include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");

$product=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM products"));
$category=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM categories"));
$user=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$order=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders"));

$pending_orders = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM orders WHERE order_status='Pending'")
);

$processing_orders = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM orders WHERE order_status='Processing'")
);

$delivered_orders = mysqli_num_rows(
    mysqli_query($conn,
    "SELECT * FROM orders WHERE order_status='Delivered'")
);


// Total Revenue
$revenue=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(total_amount) AS total
FROM orders
WHERE order_status='Delivered'
"));

$total_revenue=$revenue['total'];

if($total_revenue==""){
    $total_revenue=0;
}

?>

<div class="content">
    <h2 class="mb-4">

Dashboard

</h2>

<div class="row mt-4">

    <div class="col-md-4">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h3><?php echo $pending_orders; ?></h3>
                <h5>Pending Orders</h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h3><?php echo $processing_orders; ?></h3>
                <h5>Processing Orders</h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h3><?php echo $delivered_orders; ?></h3>
                <h5>Delivered Orders</h5>
            </div>
        </div>
    </div>

</div>


<h2 class="mb-4">



</h2>


<div class="row">

<div class="col-md-3">

<div class="card card-box bg1">

<h2>

<?php echo $product; ?>

</h2>

<h5>Total Products</h5>

</div>

</div>

<div class="col-md-3">

<div class="card card-box bg2">

<h2>

<?php echo $category; ?>

</h2>

<h5>Total Categories</h5>

</div>

</div>

<div class="col-md-3">

<div class="card card-box bg3">

<h2>

<?php echo $user; ?>

</h2>

<h5>Total Users</h5>

</div>

</div>

<div class="col-md-3">

<div class="card card-box bg4">

<h2>

<?php echo $order; ?>

</h2>

<h5>Total Orders</h5>

</div>

</div>

</div>


<div class="row mt-4">

<div class="col-md-3">

<div class="card bg-success text-white shadow">

<div class="card-body">

<h3>

৳<?php echo number_format($total_revenue); ?>

</h3>

<h5>Total Revenue</h5>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-info text-white shadow">

<div class="card-body">

<h3>

<?php echo $order; ?>

</h3>

<h5>Total Orders</h5>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-primary text-white shadow">

<div class="card-body">

<h3>

<?php echo $product; ?>

</h3>

<h5>Total Products</h5>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-dark text-white shadow">

<div class="card-body">

<h3>

<?php echo $user; ?>

</h3>

<h5>Total Users</h5>

</div>

</div>

</div>

</div>
<div class="row mt-5">

<div class="col-md-8">

<div class="card shadow">

<div class="card-header">

Monthly Sales

</div>

<div class="card-body">

<canvas id="salesChart"></canvas>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<div class="card-header">

Order Status

</div>

<div class="card-body">

<canvas id="orderChart"></canvas>

</div>

</div>

</div>

</div>

</div>

<script>

const salesChart=new Chart(

document.getElementById('salesChart'),

{

type:'bar',

data:{

labels:['Products','Categories','Users','Orders'],

datasets:[{

label:'Statistics',

data:[

<?php echo $product; ?>,

<?php echo $category; ?>,

<?php echo $user; ?>,

<?php echo $order; ?>

]

}]

}

});

const orderChart=new Chart(

document.getElementById('orderChart'),

{

type:'doughnut',

data:{

labels:[

'Pending',

'Processing',

'Delivered'

],

datasets:[{

data:[

<?php echo $pending_orders; ?>,

<?php echo $processing_orders; ?>,

<?php echo $delivered_orders; ?>

]

}]

}

});

</script>

<?php

include("includes/footer.php");

?>