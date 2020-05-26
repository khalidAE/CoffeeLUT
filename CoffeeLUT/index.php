<?php
session_start();
require('mysqli_connect.php');

$query = 'SELECT orderitem.Product_ID, Product_name, Price, count(*) FROM orderitem INNER JOIN product ON orderitem.Product_ID = product.Product_ID GROUP BY Product_ID ORDER BY count(*) DESC LIMIT 3';
$result = mysqli_query($conn, $query);

$query2 = 'SELECT * FROM product ORDER BY RAND() LIMIT 3';
$result2 = mysqli_query($conn, $query2);

?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php
$page = 'home';
include('templates/header.php');
?>



<!-- Welcome Section - Jumbotron -->
<section id="about" class="page-section">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12 padding">
                <h3>
                    It has always been, and will always be, about quality. We’re passionate about ethically sourcing
                    the finest coffee beans, roasting them with great care, and improving the lives of people who
                    grow them. We care deeply about all of this; our work is never done.
                </h3>
                <br>
                <div class="circular-bg-img"><span class="circle"><span>
                            <img src="logo2.png" />
                        </span></span>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- 3 Values -->
<div class="container-fluid padding darker">
    <div class="row text-center padding circles-section width-80">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <span class="circle">
                <i class="fas fa-coffee"></i> </span>
            <p class="three-cols-title">QUALITY COFFEE</p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <span class="circle">
                <i class="fas fa-shopping-cart"></i>
            </span>
            <p class="three-cols-title">EASY TO ORDER</p>
        </div>
        <div class="col-md-4">
            <span class="circle">
                <i class="fas fa-shipping-fast"></i>
            </span>
            <p class="three-cols-title">FAST DELIVERY</p>
        </div>
    </div>
</div>



<!-- Fixed Background -->
<figure>
    <div class="fixed-wrap">
        <div id="fixed">
        </div>
    </div>
</figure>



<!-- Featured Products -->
<section class="page-section">
    <div class="container-fluid padding">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4">Featured Products</h1>
            </div>
            <hr>
        </div>
    </div>

    <div class="padding products-wrapper">
        <?php
        while ($row = mysqli_fetch_array($result2)) {
        ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $row['Product_name']; ?></h4>
                    <img class="card-img-top" src="img/products/<?php echo $row['Product_ID']; ?>.png">
                    <p class="card-text">SR <?php echo number_format($row['Price']); ?></p>
                    </p>
                    <button class="button-primary viewBtn" data-toggle="modal" data-target="#productModal" id="<?php echo $row["Product_ID"]; ?>" name='view' href="#">View</button>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>



<!-- Bestsellers -->
<section id="team" class="page-section">
    <div class="container-fluid padding">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4">Bestsellers</h1>
            </div>
            <hr>
        </div>
    </div>

    <div class="padding products-wrapper">
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $row['Product_name']; ?></h4>
                    <img class="card-img-top" src="img/products/<?php echo $row['Product_ID']; ?>.png">
                    <p class="card-text">SR <?php echo number_format($row['Price']); ?></p>
                    </p>
                    <button class="button-primary viewBtn" data-toggle="modal" data-target="#productModal" id="<?php echo $row["Product_ID"]; ?>" name='view' href="#">View</button>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>




<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="product01Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="row">

                    <div class="col-lg-6">
                        <img class="card-img-top" src="img/products/fellow-stagg-pour-over-electric-kettle.png">
                    </div>

                    <div class="col-lg-6">
                        <h2>Fellow Stagg Pour-Over Electric Kettle</h2>
                        <p>Availability: In stock</p>
                        <p class="card-text">SR 589</p>

                        <button type="button" class="button-primary">Add to cart</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.viewBtn').click(function() {
            var Product_ID = $(this).attr("id");
            $.ajax({
                url: "view-product.php",
                method: "post",
                data: {
                    Product_ID: Product_ID,
                    Page: 'view'
                },
                success: function(data) {
                    $('.modal-body').html(data);
                    $('#productModal').modal("show");
                }
            });
        });
    });
</script>



<!-- banner -->
<div class="padding fact">
    <div class="text-center">
        <div class="col-12 fact">
            <img class="fact-img" src="img/fact.png" alt="">
        </div>
    </div>
</div>



<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>