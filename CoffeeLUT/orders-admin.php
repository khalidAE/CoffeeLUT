<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] == 'customer') {
    header('location: index.php');
}

require('mysqli_connect.php');

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

if (isset($_POST['completeBtn'])) {

    $toDeleteID = $_POST['order_id'];
    $query = "UPDATE orders SET Status = 'completed' WHERE Order_ID = $toDeleteID";

    if (mysqli_query($conn, $query)) {
        header('location: orders-admin.php');
    }
} else if (isset($_POST['deleteBtn'])) {

    $toDeleteID = $_POST['order_id'];
    $query = "DELETE FROM orders WHERE Order_ID = $toDeleteID";

    if (mysqli_query($conn, $query)) {
        header('location: orders-admin.php');
    }
}
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
                <h1 class="text-center padding">Manage Orders</h1>
            </div>
        </div>

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
                                    echo "
                                    <br>
                            <div class='row'>
                            <div class='col-4'>

                            <form action='' method='POST'>
                                <div class='form-row'>
                                <button type='submit' class='button-primary' name='completeBtn'>Mark as completed</button>
                                <button type='submit' class='button-primary button-red' name='deleteBtn' style='margin-left: 6px'>Delete</button>
                                <input type='hidden' name='order_id' value='" . $row['Order_ID'] . " '>
                                </div>
                            </form>

                        </div>
                        </div>
                                    ";
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>



<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>