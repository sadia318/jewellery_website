<?php

include('includes/connect.php');
include('includes/header.php');
include('includes/navbar.php');

?>


<div class="container mt-5">

<h2 class="text-center mb-4">
Jewellery Categories
</h2>


<div class="row">


<?php

$query = "SELECT * FROM categories";

$result = mysqli_query($conn,$query);


while($row = mysqli_fetch_assoc($result))
{

?>


<div class="col-md-4 mb-4">


<div class="card shadow text-center">


<img src="assets/images/<?php echo $row['category_image']; ?>"
class="card-img-top"
height="250">


<div class="card-body">


<h4>
<?php echo $row['category_name']; ?>
</h4>


<a href="products.php?category=<?php echo $row['category_id']; ?>"
class="btn btn-warning">

View Products

</a>


</div>


</div>


</div>


<?php

}

?>


</div>


</div>


<?php

include('includes/footer.php');

?>