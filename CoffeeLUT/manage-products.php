<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] == 'customer') {
    header('location: index.php');
}

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
}

$result = mysqli_query($conn, $query);

if (isset($_POST['add'])) {

    // Get Fields
    if (isset($_POST['availability_field']) && $_POST['availability_field'] == 1)
        $query = "INSERT INTO product (Product_name, Availability, Price, category) VALUES ('" . $_POST['name_field'] . "', '" . $_POST['availability_field'] . "', '" . $_POST['price_field'] . "', '" . $_POST['category_field'] . "')";
    else
        $query = "INSERT INTO product (Product_name, Availability, Price, category) VALUES ('" . $_POST['name_field'] . "', '" . 0 . "', '" . $_POST['price_field'] . "', '" . $_POST['category_field'] . "')";

    if (mysqli_query($conn, $query)) {
    }

    $query = "SELECT * FROM product";
    $result = mysqli_query($conn, $query);
    $last_ID = 0;

    while ($row = mysqli_fetch_array($result))
        $last_ID = $row['Product_ID'];


    // Desired image name
    $image = $last_ID . '.png';
    // image file directory
    $target = "img/products/" . $image;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        header('location: manage-products.php');
    } else {
        echo "Failed to upload image";
    }
}
?>

<!DOCTYPE html>
<html lang="en">


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

            <br>

            <button class="button-primary" data-toggle="modal" data-target="#productx" href="#">Add</button>

            <div class="products-wrapper">

                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row["Product_name"]; ?></h4>
                            <img class="card-img-top" src="img/products/<?php echo $row["Product_ID"]; ?>.png">
                            <p class="card-text">SR <?php echo number_format($row["Price"]); ?></p>
                            <button class="button-primary viewBtn" data-toggle="modal-edit" data-target="#productModal" id="<?php echo $row["Product_ID"]; ?>" name='view' href="#">Edit</button>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!-- <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fellow Stagg Pour-Over Electric Kettle</h4>
                        <img class="card-img-top" src="img/products/fellow-stagg-pour-over-electric-kettle.png">
                        <p class="card-text">SR 589</p>
                        <button class="button-primary" data-toggle="modal" data-target="#product01" href="#">View</button>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div>



<!-- Modal X - Add -->
<div class="modal fade" id="productx" tabindex="-1" role="dialog" aria-labelledby="productxLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">

                <div class="container">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <legend>Add Product</legend>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name_field">Name</label>
                                <input type="text" class="form-control" id="name_field" name="name_field" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="price_field">Price</label>
                                <input type="number" class="form-control" id="price_field" name="price_field" placeholder="Price (SR)" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="category_field">Category</label>
                                <input type="text" class="form-control" id="category_field" name="category_field" placeholder="Category">
                            </div>
                        </div>


                        <div class='form-row'>
                            <input type='Checkbox' class='availability-ckeckbox' id='availability_field' name='availability_field' value='1'>
                            <label for='availability_field'>Available</label>
                        </div>

                        <div class="form-row">
                            <label for="picture_field">Select a picture:</label>
                            <input type='file' name='image' class='form-control' id='picutre_field'>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="add" class="button-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal 1 -->
<div class="modal fade modal-edit" id="productModal" tabindex="-1" role="dialog" aria-labelledby="product01Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid modal-body-edit">


                <div class="container">
                    <form method="POST" action="view-product.php" enctype="multipart/form-data" name='saveForm' id="saveForm">
                        <legend>Add Product</legend>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name_field">Name</label>
                                <input type="text" class="form-control" id="name_field" name="name_field" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="price_field">Price</label>
                                <input type="number" class="form-control" id="price_field" name="price_field" placeholder="Price (SR)" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="category_field">Category</label>
                                <input type="text" class="form-control" id="category_field" name="category_field" placeholder="Category">
                            </div>
                        </div>


                        <div class='form-row'>
                            <input type='Checkbox' class='availability-ckeckbox' id='availability_field' name='availability_field' value='1' required>
                            <label for='availability_field'>Available</label>
                        </div>

                        <div class="form-row">
                            <label for="picture_field">Select a picture:</label>
                            <input type='file' name='image' class='form-control' id='picutre_field'>
                        </div>

                        <div class="form-group">
                            <button class='button-primary saveBtn' type="submit">Save Changes</button>
                            <button type='button' class='button-primary button-red deleteBtn'>Delete</button>
                        </div>
                    </form>
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
                    Page: 'edit'
                },
                success: function(data) {
                    $('.modal-body-edit').html(data);
                    $('#productModal').modal("show");
                }
            });
        });

        // $('.saveBtn').click(function() {
        //     var Product_ID = $(this).attr("id");
        //     $.ajax({
        //         url: "view-product.php",
        //         method: "post",
        //         data:{
        //             Product_ID: Product_ID,
        //             Page: 'save'

        //         },
        //         success: function(data){
        //             header("location: manage-products.php");
        //         }
        //     });


        // });


    });


    $('#saveForm').submit(function() {
        return false;
    });
</script>



<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>