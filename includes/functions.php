<?php

function getCategories()
{
    global $conn;

    $select_query = "SELECT * FROM categories ORDER BY category_title ASC";
    $result = mysqli_query($conn, $select_query);

    while ($row = mysqli_fetch_assoc($result)) {

        $category_id = $row['category_id'];
        $category_title = $row['category_title'];

        echo "
        <li class='nav-item'>
            <a href='category.php?category=$category_id' class='nav-link'>
                $category_title
            </a>
        </li>";
    }
}

function getProducts()
{
    global $conn;

    $query = "SELECT * FROM products
              WHERE status='true'
              ORDER BY product_id DESC";

    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100">

                <img src="assets/images/products/<?php echo $row['product_image1']; ?>"
                     class="card-img-top">

                <div class="card-body">

                    <h5 class="card-title">
                        <?php echo $row['product_title']; ?>
                    </h5>

                    <p class="card-text">
                        <?php echo substr($row['product_description'],0,60); ?>...
                    </p>

                    <h5 class="text-custom-maroon">
                        ৳<?php echo number_format($row['product_price']); ?>
                    </h5>

                    <div class="d-grid gap-2">

                        <a href="cart.php?add=<?php echo $row['product_id']; ?>"
                           class="btn btn-custom">

                            <i class="fas fa-cart-plus"></i>

                            Add To Cart

                        </a>

                        <a href="product_details.php?id=<?php echo $row['product_id']; ?>"
                           class="btn btn-outline-dark">

                            <i class="fas fa-eye"></i>

                            View Details

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <?php
    }
}

?>