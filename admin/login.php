<?php
include("includes/connect.php");

$message="";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = mysqli_query($conn,"SELECT * FROM admins WHERE admin_email='$email'");

    if(mysqli_num_rows($query)==1){

        $admin = mysqli_fetch_assoc($query);

        if($password == $admin['admin_password']){

            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['admin_name'];

            header("Location: dashboard.php");
            exit();

        }else{

            $message="<div class='alert alert-danger'>
            Wrong Password
            </div>";

        }

    }else{

        $message="<div class='alert alert-danger'>
        Admin Email Not Found
        </div>";

    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card shadow">

<div class="card-header bg-dark text-white text-center">

<h3>Admin Login</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email"
required>

</div>

<div class="mb-3">

<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-dark w-100">

Login

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>