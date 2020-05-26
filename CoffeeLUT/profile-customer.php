<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php
$page = 'profile';
include('templates/header.php');
?>


<!-- Grid -->
<section>
    <div class="container text-center">
        <h2>Hello, <strong><?php echo $_SESSION['first_name']; ?></strong>!</h2>
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

        <buttON onclick="window.location= 'orders-user.php'">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Orders</h4>
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