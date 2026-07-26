<?php
include("includes/connect.php");
include("includes/header.php");
include("includes/navbar.php");

$message = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password,$row['user_password'])){

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];

            header("Location: index.php");
            exit();

        }else{

            $message = "<div class='alert alert-danger'>
            Incorrect Password.
            </div>";

        }

    }else{

        $message = "<div class='alert alert-danger'>
        Email Not Found.
        </div>";

    }

}
?>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>User Login</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

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

<button
type="submit"
name="login"
class="btn btn-custom w-100">

Login

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