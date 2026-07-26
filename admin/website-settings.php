<?php

include("includes/connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

$setting=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM website_settings LIMIT 1
"));

$message="";

if(isset($_POST['update'])){

$name=$_POST['website_name'];
$contact=$_POST['contact'];
$email=$_POST['email'];
$address=$_POST['address'];
$facebook=$_POST['facebook'];
$instagram=$_POST['instagram'];
$footer=$_POST['footer'];

$logo=$setting['logo'];

if($_FILES['logo']['name']!=""){

$logo=$_FILES['logo']['name'];

move_uploaded_file(

$_FILES['logo']['tmp_name'],

"uploads/".$logo

);

}

mysqli_query($conn,"

UPDATE website_settings SET

website_name='$name',

logo='$logo',

contact='$contact',

email='$email',

address='$address',

facebook='$facebook',

instagram='$instagram',

footer='$footer'

WHERE setting_id=1

");

$message="<div class='alert alert-success'>
Settings Updated Successfully
</div>";

$setting=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM website_settings LIMIT 1
"));

}

include("includes/header.php");
include("includes/navbar.php");
include("includes/sidebar.php");

?>

<div class="content">

<h2>Website Settings</h2>

<?php echo $message; ?>

<form method="POST" enctype="multipart/form-data">

<div class="card shadow p-4">

<label>Website Name</label>

<input
type="text"
name="website_name"
class="form-control mb-3"
value="<?php echo $setting['website_name'];?>">

<label>Current Logo</label>

<br>

<img
src="uploads/<?php echo $setting['logo'];?>"
width="120"
class="mb-3">

<label>Change Logo</label>

<input
type="file"
name="logo"
class="form-control mb-3">

<label>Contact</label>

<input
type="text"
name="contact"
class="form-control mb-3"
value="<?php echo $setting['contact'];?>">

<label>Email</label>

<input
type="email"
name="email"
class="form-control mb-3"
value="<?php echo $setting['email'];?>">

<label>Address</label>

<textarea
name="address"
class="form-control mb-3"><?php echo $setting['address'];?></textarea>

<label>Facebook</label>

<input
type="text"
name="facebook"
class="form-control mb-3"
value="<?php echo $setting['facebook'];?>">

<label>Instagram</label>

<input
type="text"
name="instagram"
class="form-control mb-3"
value="<?php echo $setting['instagram'];?>">

<label>Footer</label>

<textarea
name="footer"
class="form-control mb-3"><?php echo $setting['footer'];?></textarea>

<button
class="btn btn-success"
name="update">

Save Settings

</button>

</div>

</form>

</div>

<?php include("includes/footer.php"); ?>