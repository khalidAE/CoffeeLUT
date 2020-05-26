<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header('location: index.php');
}

require('mysqli_connect.php');

if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {

    // DB insertion:

    // orders Table:           
    $total = 0;
    foreach ($_SESSION["cart"] as $keys => $values) {
        $total = $total + ($values["product_quantity"] * $values["product_price"]);
    }

    $order_total = ($total * 1.05) + 15;
    $order_date = date("Y/m/d");

    $query = 'SELECT First_name, Address1, Address2, City, Country FROM customer WHERE Customer_ID = ' . $_SESSION['customer_ID'];
    $address = '-';

    if ($result = mysqli_query($conn, $query)) {
        $row = mysqli_fetch_array($result);
        $address = $row['Address1'] . ' - ' . $row['Address2'] . ', ' . $row['City'] . ', ' . $row['Country'];
        $fname = $row['First_name'];
    }

    $query = 'INSERT INTO orders (Customer_ID, Order_date, Total, Address) VALUES ("' . $_SESSION['customer_ID'] . '", "' . $order_date . '", "' . $order_total . '", "' . $address . '")';
    if (mysqli_query($conn, $query)) {
        $query = 'SELECT Order_ID FROM orders ORDER BY Order_ID DESC LIMIT 1';
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['Order_ID'];
        }
    } else {
        echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }

    // orderitem Table:
    foreach ($_SESSION["cart"] as $keys => $values) {

        $query = 'INSERT INTO orderitem (Order_ID, Product_ID, Quantity, Total) VALUES ("'
            . $order_id . '", "' . $values["product_id"] . '", "' . $values["product_quantity"] . '", "' . ($values["product_quantity"] * $values["product_price"]) . '")';
        if (mysqli_query($conn, $query)) {
        } else {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }
    }
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

            <img src="img/emoji-1.png" alt="" width="100px" style="margin-bottom: 25px">
            <br>
            <h1>You're all sorted. Thanks, <?php echo $fname; ?>.</h1>
            <h2>Your order has been recieved and is currently being processed by our crew.</h2>

            <div class="container">
                Your order number is #<?php echo $order_id; ?>

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


<?php
unset($_SESSION['cart']);
?>