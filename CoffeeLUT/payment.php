<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header('location: index.php');
}

if (isset($_POST['makeOrderBtn'])) {
    header('location: successfulOrder.php');
}
?>

<!DOCTYPE html>
<html lang="en">


<?php
$page = 'payment';
include('templates/header.php');
?>


<!-- Payment Method Choices -->
<div class="container-fluid padding darker">
    <div class="row text-center padding circles-section width-80">
        <div class="col-lg-10" style="margin: 0 auto;">

            <h1 class="title-section">Select payment method</h1>

            <div class="container">
                <form action="" method="POST">
                    <div class="cc-selector">
                        <input checked="checked" id="visa" type="radio" name="credit-card" value="visa" />
                        <label class="drinkcard-cc visa" for="visa"></label>

                        <input id="mada" type="radio" name="credit-card" value="mada" />
                        <label class="drinkcard-cc mada" for="mada"></label>

                        <input id="cod" type="radio" name="credit-card" value="cod" />
                        <label class="drinkcard-cc cod" for="cod"></label>
                    </div>

                    <button name="makeOrderBtn" type="submit" class="button-primary">Make Order</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Grid of cart -->
<div class="container-fluid padding lighter">
    <div class="row text-center padding circles-section width-80">

        <!-- Products -->
        <div class="col-lg-8">
            <h1 class="title-section">Cart</h1>

            <div class="products-wrapper">
                <?php
                if (!empty($_SESSION["cart"])) {
                    $empty = false;
                    $total = 0;
                    foreach ($_SESSION["cart"] as $keys => $values) {
                ?>
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img class="card-img-top" src="img/products/<?php echo $values["product_id"]; ?>.png">
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="itemNumber">SR <?php echo number_format($values["product_price"]); ?> — #<?php echo $values["product_quantity"]; ?></p>
                                        <h4 class="card-title"><?php echo $values["product_name"]; ?></h4>
                                        <p class="card-text">SR <?php echo number_format($values["product_quantity"] * $values["product_price"]); ?></p>
                                    </div>
                                    <div class="col-lg-1">
                                        <form action="add-To-Cart.php" method="POST">
                                            <button type="submit" name="deleteFromCartBtn" class="button-primary button-cricle button-red" href="#">X</button>
                                            <input type="hidden" name="product_id" value="<?php echo $values["product_id"]; ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $total = $total + ($values["product_quantity"] * $values["product_price"]);
                    }
                } else {
                    echo 'Your cart is empty!';
                    $total = 0;
                    $empty = true;
                }
                ?>
            </div>
        </div>

        <!-- Totals -->
        <div class=" col-md-12 col-lg-4 darker">
            <?php
            if (!$empty) {
            ?>
                <div class="container-fluid width-80">


                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="title-section">Total</h1>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-6 text-right">
                            <h4>Subtotal</h4>
                            <h4>Shipping</h4>
                            <h4>VAT</h4>
                            <h2>Total</h2>
                        </div>

                        <div class="col-6 text-left">
                            <h4>SR <?php echo number_format($total); ?></h4>
                            <h4>SR 15</h4>
                            <h4>SR <?php echo number_format(0.05 * $total); ?></h4>
                            <h2>SR <?php echo number_format(1.05 * $total + 15); ?></h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>

    </div>
</div>



<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>