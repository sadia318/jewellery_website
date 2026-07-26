<?php
include("includes/connect.php");
include("includes/header.php");
include("includes/navbar.php");

$message = "";

if(isset($_POST['register'])){

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    // Password Match Check
    if($password != $confirm){
        $message = "<div class='alert alert-danger'>Passwords do not match.</div>";
    }else{

        // Email Check
        $check = mysqli_query($conn,"SELECT * FROM users WHERE user_email='$email'");

        if(mysqli_num_rows($check)>0){

            $message = "<div class='alert alert-warning'>Email already exists.</div>";

        }else{

            $hash = password_hash($password,PASSWORD_DEFAULT);

            mysqli_query($conn,"
            INSERT INTO users(username,user_email,user_password)
            VALUES('$username','$email','$hash')
            ");

            $message = "<div class='alert alert-success'>
            Registration Successful. Please Login.
            </div>";
        }

    }

}
?>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3 class="mb-0">Create Account</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Full Name</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm"
class="form-control"
required>

</div>

<button
class="btn btn-custom w-100"
name="register">

Register

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