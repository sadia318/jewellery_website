<?php

include("../includes/connect.php");


if(isset($_POST['create_account'])){


$username = $_POST['username'];

$email = $_POST['email'];

$phone = $_POST['phone'];

$address = $_POST['address'];

$password = $_POST['password'];

$confirm_password = $_POST['confirm_password'];



if($password != $confirm_password){

echo "<script>
alert('Password does not match');
window.history.back();
</script>";

exit();

}



// Check Email

$check_email = "SELECT * FROM users 
WHERE email='$email'";


$result = mysqli_query($con,$check_email);



if(mysqli_num_rows($result)>0){


echo "<script>

alert('Email already exists');

window.history.back();

</script>";


exit();


}





// Password Encrypt

$hash_password = password_hash(
$password,
PASSWORD_DEFAULT
);





$insert_query = "

INSERT INTO users

(username,email,phone,address,password)

VALUES

('$username',
'$email',
'$phone',
'$address',
'$hash_password')

";



$result_query = mysqli_query(
$con,
$insert_query
);



if($result_query){


echo "<script>

alert('Registration Successful');

window.location='../login.html';

</script>";


}



}


?>