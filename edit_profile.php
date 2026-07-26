<?php
include("includes/connect.php");
include("includes/header.php");
include("includes/navbar.php");

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$user_id=$_SESSION['user_id'];

$result=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$user_id'");
$user=mysqli_fetch_assoc($result);

$message="";

if(isset($_POST['update_profile'])){

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);

    $update="UPDATE users SET

    username='$username',
    user_email='$email',
    user_address='$address',
    user_mobile='$mobile'

    WHERE user_id='$user_id'";

    if(mysqli_query($conn,$update)){

        $_SESSION['username']=$username;

        $message="<div class='alert alert-success'>
        Profile Updated Successfully.
        </div>";

        $result=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$user_id'");
        $user=mysqli_fetch_assoc($result);

    }else{

        $message="<div class='alert alert-danger'>
        Failed to Update Profile.
        </div>";

    }

}
?>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>Edit Profile</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Name</label>

<input
type="text"
name="username"
class="form-control"
value="<?php echo $user['username']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $user['user_email']; ?>"
required>

</div>

<div class="mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
rows="3"><?php echo $user['user_address']; ?></textarea>

</div>

<div class="mb-3">

<label>Mobile</label>

<input
type="text"
name="mobile"
class="form-control"
value="<?php echo $user['user_mobile']; ?>">

</div>

<button
type="submit"
name="update_profile"
class="btn btn-custom">

Update Profile

</button>

<a href="profile.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<?php
include("includes/footer.php");
?>