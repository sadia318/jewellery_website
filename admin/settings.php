<?php

include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$id=$_SESSION['admin_id'];

$admin=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM admins
WHERE admin_id='$id'
"));

$message="";

if(isset($_POST['update'])){

    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    mysqli_query($conn,"
    UPDATE admins SET

    admin_name='$name',
    admin_email='$email',
    admin_password='$password'

    WHERE admin_id='$id'
    ");

    $_SESSION['admin_name']=$name;

    $message="<div class='alert alert-success'>
    Profile Updated Successfully.
    </div>";

    $admin=mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM admins
    WHERE admin_id='$id'
    "));
}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");
?>

<div class="content">

<h2 class="mb-4">

Admin Settings

</h2>

<?php echo $message; ?>

<div class="card shadow">

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Admin Name</label>

<input
type="text"
name="name"
class="form-control"
value="<?php echo $admin['admin_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $admin['admin_email']; ?>"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="text"
name="password"
class="form-control"
value="<?php echo $admin['admin_password']; ?>"
required>

</div>

<button
class="btn btn-success"
name="update">

Update Profile

</button>

</form>

</div>

</div>

</div>

<?php
include("includes/footer.php");
?>