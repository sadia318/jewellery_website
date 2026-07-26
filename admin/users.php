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

<h2 class="mb-4">User Management</h2>

<div class="card shadow">

<div class="card-body">

<form method="GET" class="mb-3">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="search"
class="form-control"
placeholder="Search User">

</div>

<div class="col-md-2">

<button class="btn btn-dark w-100">

Search

</button>

</div>

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Registered</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

if(isset($_GET['search'])){

    $search=mysqli_real_escape_string($conn,$_GET['search']);

    $query=mysqli_query($conn,"
    SELECT * FROM users

    WHERE username LIKE '%$search%'

    OR user_email LIKE '%$search%'
    ");

}else{

    $query=mysqli_query($conn,"
    SELECT * FROM users
    ORDER BY user_id DESC
    ");

}

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?php echo $row['user_id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['user_email']; ?></td>

<td><?php echo $row['user_mobile']; ?></td>

<td><?php echo $row['user_registered']; ?></td>

<td>

<a
href="delete-user.php?id=<?php echo $row['user_id'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete User?')">

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