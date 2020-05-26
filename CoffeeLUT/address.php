<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header('location: index.php');
}

require('mysqli_connect.php');

if (isset($_POST['addressBtn'])) {

    $customer_id = $_SESSION['customer_ID'];
    $query = "UPDATE customer SET Phone_number = '" . $_POST['phone_field'] . "', Country = '" . $_POST['country_field'] . "', City = '" . $_POST['city_field'] . "', Address1 = '" . $_POST['address1_field'] . "', Address2 = '" . $_POST['address2_field'] . "', Notes = '" . $_POST['notes_field'] . "' WHERE Customer_ID = $customer_id";

    if (mysqli_query($conn, $query)) {
        header('location: address.php');
    } else {
        echo 'Error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Header -->
<?php
$page = 'cart';
include('templates/header.php');
?>



<!-- Address Choices -->
<div class="container-fluid padding darker">
    <div class="row text-center padding circles-section width-80">
        <div class="col-lg-10" style="margin: 0 auto;">

            <div class="row">
                <div class="col-lg-12">
                    <h1>Shipping Address</h1>
                </div>
            </div>
            <div class="padding select-billing-address">
                <div class="title">
                    <h2>Registered Address</h2>
                </div>
                <div class="address-grid">
                    <div class="address-item">

                        <?php if (isset($_SESSION['customer_ID'])) {

                            $query = 'SELECT * FROM customer WHERE Customer_ID = ' . $_SESSION['customer_ID'];
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);

                            if (isset($row['Address1'])) { ?>
                                <div class="row justify-content-center">
                                    <div class="col-4 text-right text-right text-bold">Name</div>
                                    <div class="col-4 text-left"><?php echo $row['First_name'] . ' ' . $row['Last_name']; ?></div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-4 text-right text-bold">Email</div>
                                    <div class="col-4 text-left"><?php echo $row['Email']; ?></div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-4 text-right text-bold">Phone Number</div>
                                    <div class="col-4 text-left"><?php echo $row['Phone_number']; ?></div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-4 text-right text-bold">Address</div>
                                    <div class="col-4 text-left"><?php echo $row['Country']; ?>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-4 text-right text-bold">Notes</div>
                                    <div class="col-4 text-left"><?php echo $row['Notes']; ?></div>
                                </div>

                                <div class="row justify-content-center padding">
                                    <div class="col-12">
                                        <button class="button-primary" onclick="window.location= 'payment.php'">Continue
                                            with this address</button>
                                    </div>
                                </div>

                        <?php
                            } else {
                                echo '<br>
                        <p>You don\'t have any registred address.</p>';
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>

            <hr>
            <h2 class="padding">Or enter new address</h2>



            <div class="container">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email_field">Email</label>
                            <input type="email" class="form-control" id="email_field" name="email_field" placeholder="Email address" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_field">Phone Number</label>
                            <input type="text" class="form-control" id="phone_field" name="phone_field" placeholder="Phone Number" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="country_field">Country</label>
                            <select class="form-control" name="country_field" required>
                                <option value="" selected disabled>Select...</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="United States">United States</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="Spain">Spain</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="city_field">City</label>
                            <select class="form-control" name="city_field" required>
                                <option value="" selected disabled>Select...</option>
                                <option value="Riyadh">Riyadh</option>
                                <option value="Dammam">Dammam</option>
                                <option value="Medina">Medina</option>
                                <option value="Jeddah">Jeddah</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address1_field">Address 1</label>
                            <input type="text" class="form-control" id="address1_field" name="address1_field" placeholder="Address 1" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address2_field">Address 2</label>
                            <input type="text" class="form-control" id="address2_field" name="address2_field" placeholder="Address 2" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes_field">Notes</label>
                        <textarea id="notes_field" name="notes_field" class="form-control" placeholder="Type your message here" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" name='addressBtn' class="button-primary">UPDATE</button>
                    </div>
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