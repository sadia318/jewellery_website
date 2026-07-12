<?php

session_start();

include("../includes/connect.php");


if(isset($_POST['login'])){


$email = $_POST['email'];

$password = $_POST['password'];



$query = "SELECT * FROM users WHERE email='$email'";


$result = mysqli_query($con,$query);



if(mysqli_num_rows($result)>0){


$row = mysqli_fetch_assoc($result);



if(password_verify($password,$row['password'])){


$_SESSION['user_id'] = $row['user_id'];

$_SESSION['username'] = $row['username'];



echo "

<script>

alert('Login Successful');

window.location='../index.html';

</script>

";



}

else{


echo "

<script>

alert('Wrong Password');

window.history.back();

</script>

";


}



}

else{


echo "

<script>

alert('Email not found');

window.history.back();

</script>

";


}


}



?>