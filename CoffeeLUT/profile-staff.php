<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'staff') {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">


<?php
$page = 'profile';
include('templates/header.php');
?>


<!-- Grid -->
<section>

    <div class="container text-center">
        <h2>Hello, <strong><?php echo $_SESSION['first_name']; ?></strong>!</h2>
        <p>(<?php echo ucfirst($_SESSION['user_type']); ?>)</p>
    </div>

    <div class="padding products-wrapper">

        <buttON onclick="window.location.href = 'edit-profile.php';">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Information</h4>
                    <i class="fas fa-user-circle card-img-top"></i>
                    <p class="card-text"></p>
                </div>
            </div>
        </buttON>

        <buttON onclick="window.location.href = 'manage-products.php';">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Products</h4>
                    <i class="fas fa-tags card-img-top"></i>
                    <p class="card-text"></p>
                </div>
            </div>
        </buttON>

        <buttON onclick="window.location= 'orders-admin.php'">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Orders</h4>
                    <i class="fas fa-shopping-cart card-img-top"></i>
                    <p class="card-text"></p>
                </div>
            </div>
        </buttON>
    </div>
</section>



<!-- Footer -->
<?php
include('templates/footer.php');
?>

</html>