<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm px-3">

    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand logo-link" href="index.php">
            <img src="assets/images/sadia logo.jpg"
                 alt="Luxury Jewellery"
                 class="gleam-logo">
        </a>

        <!-- Mobile Button -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

              <li class="nav-item">
<a class="nav-link" href="products.php">
Products
</a>
</li>

 

</li>

                <li class="nav-item">

<a class="nav-link" href="about.php">
About
</a>

</li>

                

                <?php if(isset($_SESSION['user_id'])){ ?>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">My Account</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                <?php } ?>

                <!-- Cart -->
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">

                        <i class="fa-solid fa-cart-shopping"></i>

                        <sup class="badge bg-danger">

                        <?php
                        if(isset($_SESSION['cart'])){
                            echo count($_SESSION['cart']);
                        }else{
                            echo 0;
                        }
                        ?>

                        </sup>

                    </a>
                </li>

                <!-- Total -->
                <li class="nav-item">
                    <a class="nav-link text-custom-maroon fw-bold">

                        Total :
                        ৳<?php
                        if(isset($_SESSION['cart_total'])){
                            echo $_SESSION['cart_total'];
                        }else{
                            echo "0";
                        }
                        ?>

                    </a>
                </li>

            </ul>

            <!-- Search -->
            <form class="d-flex" action="search.php" method="GET">

                <input
                    class="form-control me-2"
                    type="search"
                    name="search"
                    placeholder="Search Jewellery..."
                    required>

                <button class="btn btn-custom" type="submit">
                    <i class="fas fa-search"></i>
                </button>

            </form>

        </div>

    </div>

    

</nav>


