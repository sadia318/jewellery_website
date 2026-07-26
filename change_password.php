<?php
include("includes/connect.php");
include("includes/header.php");
include("includes/navbar.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if(isset($_POST['change_password'])){

    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // User Data
    $query = mysqli_query($conn,"SELECT * FROM users WHERE user_id='$user_id'");
    $user = mysqli_fetch_assoc($query);

    // Current Password Check
    if(!password_verify($current_password,$user['user_password'])){

        $message = "<div class='alert alert-danger'>
        Current Password is Incorrect.
        </div>";

    }

    // New Password Match
    elseif($new_password != $confirm_password){

        $message = "<div class='alert alert-warning'>
        New Password & Confirm Password do not match.
        </div>";

    }

    else{

        $hash = password_hash($new_password,PASSWORD_DEFAULT);

        mysqli_query($conn,"
        UPDATE users
        SET user_password='$hash'
        WHERE user_id='$user_id'
        ");

        $message = "<div class='alert alert-success'>
        Password Changed Successfully.
        </div>";

    }

}
?>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>Change Password</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Current Password</label>

<input
type="password"
name="current_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>New Password</label>

<input
type="password"
name="new_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<button
type="submit"
name="change_password"
class="btn btn-custom w-100">

Change Password

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<?php
include("includes/footer.php");
?>