<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header('location: index.php');
}

require('mysqli_connect.php');

$query = "SELECT * FROM orders WHERE Customer_ID = " . $_SESSION['customer_ID'];
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">


<?php
$page = 'history';
include('templates/header.php');
?>



<!-- Grid -->
<section class="page-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center padding">History of Orders</h1>
            </div>
        </div>

        <?php
        if (mysqli_num_rows($result) < 1) {
            echo '<p style="text-align: center">Sorry, you don\'t have any previous order.</p>';
        } else {
        ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Details</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>


                        <!-- orders Table -->
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr class="accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo $row['Order_ID']; ?>">
                                <td class="expand-button"></td>
                                <td><?php echo $row['Order_ID']; ?></td>
                                <td><?php echo $row['Order_date']; ?></td>
                                <td>SR <?php echo number_format($row['Total'], 2); ?></td>
                                <td><?php echo ucfirst($row['Status']); ?></td>
                            </tr>


                            <!-- orderitem Table -->
                            <tr class="hide-table-padding">
                                <td></td>
                                <td colspan="6">
                                    <div id="collapse<?php echo $row['Order_ID']; ?>" class="collapse in p-3">
                                        <div class="row">
                                            <div class="col-4"><strong>Name</strong></div>
                                            <div class="col-3"><strong>Price</strong></div>
                                            <div class="col-1"></div>
                                            <div class="col-1"></div>
                                            <div class="col-2"></div>
                                        </div>

                                        <?php
                                        $query = 'SELECT * FROM orderitem WHERE Order_ID = ' . $row['Order_ID'];
                                        $result2 =  mysqli_query($conn, $query);
                                        $stupid = true;

                                        while ($row2 = mysqli_fetch_array($result2)) {

                                            $query = 'SELECT * FROM product WHERE Product_ID = ' . $row2['Product_ID'];
                                            $result3 =  mysqli_query($conn, $query);

                                            while ($row3 = mysqli_fetch_array($result3)) {

                                                if ($stupid) {
                                                    echo "
                                            <div class='row'>
                                            <div class='col-4'>" . $row3['Product_name'] . "</div>
                                            <div class='col-3'>SR " . number_format($row2['Total'], 2) . "</div>
                                            <div class='col-1'></div>
                                            <div class='col-1'><strong>Subtotal</strong></div>
                                            <div class='col-2'><strong>SR " . $row['Total'] . "</strong></div>
                                        </div>
                                                ";

                                                    $stupid = false;
                                                } else {
                                        ?>
                                                    <div class="row">
                                                        <div class="col-4"><?php echo $row3['Product_name']; ?></div>
                                                        <div class="col-2">SR <?php echo number_format($row2['Total'], 2); ?></div>
                                                        <div class="col-1"></div>
                                                        <div class="col-3"></div>
                                                        <div class="col-2"></div>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</section>



<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>