<?php
session_start();
require('mysqli_connect.php');

$query = "SELECT * FROM product";

if (isset($_GET['category'])) {
    if ($_GET['category'] == 'grinders')
        $query = $query . " WHERE category = 'grinders'";

    else if ($_GET['category'] == 'drippers')
        $query = $query . " WHERE category = 'drippers'";

    else if ($_GET['category'] == 'espresso-tools')
        $query = $query . " WHERE category = 'espresso-tools'";

    else if ($_GET['category'] == 'cups-glasses')
        $query = $query . " WHERE category = 'cups-glasses'";

    else if ($_GET['category'] == 'kettles')
        $query = $query . " WHERE category = 'kettles'";

    else if ($_GET['category'] == 'coffee')
        $query = $query . " WHERE category = 'coffee'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">


<!-- Header -->
<?php
$page = 'products';
include('templates/header.php');
?>



<!-- Grid -->
<div class="container-fluid padding darker">
    <div class="row text-center padding circles-section width-80">

        <!-- Filter -->
        <div class="d-none d-lg-block col-lg-3 filters">
            <div id="accordion" class="panel panel-primary behclick-panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Search Filters</h3>
                </div>
                <div class="panel-body">

                    <!-- category -->
                    <div class="panel-heading ">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse0">
                                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> Category
                            </a>
                        </h4>
                    </div>
                    <div id="collapse0" class="panel-collapse collapse show">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        Grinderes
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        Drippers
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        Espresso Tools
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        Cups & Glasses
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        Kettles
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Price -->
                    <div class="panel-heading ">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse1">
                                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> Price
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse show">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        SR 10 - 99
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        SR 100 - 299
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        SR 300 - 499
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        More Than SR 500
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Brand -->
                    <div class="panel-heading ">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse2">
                                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> Brand
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse show in">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        HARIO
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">

                                        Coffee LUT
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        Breville
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>

        <!-- Products -->
        <div class=" col-md-12 col-lg-9 page">
            <div class="product-sorting">
                <span>Sort by</span>
                <select id="products-orderby" name="products-orderby" class="sortOptionsDropDown" tabindex="13">
                    <option selected="selected" value="0">Position</option>
                    <option value="5">Name: A to Z</option>
                    <option value="6">Name: Z to A</option>
                    <option value="10">Price: Low to High</option>
                    <option value="11">Price: High to Low</option>
                    <option value="15">Created on</option>
                </select>
            </div>

            <div class="products-wrapper">

                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row["Product_name"]; ?></h4>
                            <img class="card-img-top" src="img/products/<?php echo $row["Product_ID"]; ?>.png">
                            <p class="card-text">SR <?php echo number_format($row["Price"]); ?></p>
                            <button class="button-primary viewBtn" data-toggle="modal" data-target="#productModal" id="<?php echo $row["Product_ID"]; ?>" name='view' href="#">View</button>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>



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




<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>