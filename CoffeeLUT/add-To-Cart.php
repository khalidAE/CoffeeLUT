<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header('location: index.php');
}

require('mysqli_connect.php');

if (isset($_POST['addToCartBtn'])) {

    // Adding product to Cart array in Session.
    if (isset($_SESSION["cart"])) {

        if (in_array($_POST["product_id"], array_column($_SESSION["cart"], "product_id"))) {
            $count = array_search($_POST["product_id"], array_column($_SESSION["cart"], "product_id"));

            $item_array = array(
                'product_id'            =>    $_SESSION['cart'][$count]['product_id'],
                'product_name'            =>    $_SESSION['cart'][$count]['product_name'],
                'product_price'        =>    $_SESSION['cart'][$count]['product_price'],
                'product_quantity'        =>    $_POST["quant"] + $_SESSION['cart'][$count]['product_quantity']
            );
        } else {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id'            =>    $_POST["product_id"],
                'product_name'            =>    $_POST["product_name"],
                'product_price'        =>    $_POST["product_price"],
                'product_quantity'        =>    $_POST["quant"]
            );
        }

        $_SESSION["cart"][$count] = $item_array;
    } else {
        $item_array = array(
            'product_id'            =>    $_POST["product_id"],
            'product_name'            =>    $_POST["product_name"],
            'product_price'        =>    $_POST["product_price"],
            'product_quantity'        =>    $_POST["quant"]
        );
        $_SESSION["cart"][0] = $item_array;
    }
    echo '<script>window.location="all-products.php"</script>';
} else if (isset($_POST['deleteFromCartBtn']) && isset($_SESSION["cart"])) {

    $index = array_search($_POST["product_id"], array_column($_SESSION["cart"], "product_id"));

    unset($_SESSION["cart"][$index]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]); // 'reindex' array
    echo '<script>window.location="cart.php"</script>';
}
