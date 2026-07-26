<?php
include("includes/connect.php");
include("includes/functions.php");
include("includes/header.php");
include("includes/navbar.php");
?>


<script>document.title='e-commerce website';</script>

<!-- Hero Section -->
<section class="hero-section py-5">
    <div class="container">

        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-6">

                <span class="badge bg-warning text-dark mb-3 px-3 py-2">
                    ✨ New Jewellery Collection 2026
                </span>

                <h1 class="display-4 fw-bold mb-3">
                    Shine With <span class="text-warning">Luxury Jewellery</span>
                </h1>

                <p class="lead text-muted mb-4">
                    Discover elegant rings, necklaces, bracelets, earrings and
                    exclusive wedding collections crafted with love and perfection.
                </p>

                <a href="products.php" class="btn btn-custom btn-lg me-3">
                    Shop Now
                </a>

                <a href="about.php" class="btn btn-outline-dark btn-lg">
                    Learn More
                </a>

            </div>

            <!-- Right Image -->
            <div class="col-lg-6 text-center mt-4 mt-lg-0">

                <img src="assets/images/banner.jpg"
                     class="img-fluid hero-image"
                     alt="Luxury Jewellery">

            </div>

        </div>

    </div>
</section>



<!-- Hero Banner -->
<div class="container my-4">
    <div class="hero-banner">
        Discover Timeless Jewellery For Every Occasion
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-lg-3 mb-4 sidebar">
            <h4>Categories</h4>
            <ul class="navbar-nav">
                <?php getCategories(); ?>
            </ul>

            <h4 class="mt-4">Collections</h4>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">Wedding Collection</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Diamond Collection</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Gold Collection</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Silver Collection</a>
                </li>
            </ul>
        </div>

        <!-- Products -->
        <div class="col-lg-9">
            <div class="row g-4">
                <?php getProducts(); ?>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>















