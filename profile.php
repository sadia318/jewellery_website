<?php
include("includes/connect.php");
include("includes/header.php");
include("includes/navbar.php");

// Login Check
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,"SELECT * FROM users WHERE user_id='$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<div class="container py-5">

<div class="row">

    <!-- Sidebar -->
    <div class="col-md-3">

        <div class="list-group shadow">

            <a href="profile.php"
               class="list-group-item list-group-item-action active">

               My Dashboard

            </a>

            <a href="my_orders.php"
               class="list-group-item list-group-item-action">

               My Orders

            </a>

            <a href="edit_profile.php"
               class="list-group-item list-group-item-action">

               Edit Profile

            </a>

           <a href="change_password.php"
class="list-group-item list-group-item-action">

Change Password

</a>
            <a href="logout.php"
               class="list-group-item list-group-item-action text-danger">

               Logout

            </a>

        </div>

    </div>

    <!-- Content -->
    <div class="col-md-9">

        <div class="card shadow">

            <div class="card-header bg-dark text-white">

                <h4>Welcome, <?php echo $user['username']; ?></h4>

            </div>

            <div class="card-body">

                <table class="table">

                    <tr>
                        <th>Name</th>
                        <td><?php echo $user['username']; ?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?php echo $user['user_email']; ?></td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>
                            <?php
                            echo $user['user_address'] ?: "Not Added";
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Mobile</th>
                        <td>
                            <?php
                            echo $user['user_mobile'] ?: "Not Added";
                            ?>
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

</div>

<?php
include("includes/footer.php");
?>