<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('location: index.php');
}

require('mysqli_connect.php');

if (isset($_POST['Page'])) {

    if ($_POST['Page'] == 'delete') {

        $id = $_POST["Product_ID"] + 1;
        $query = "DELETE FROM product WHERE Product_ID = $id ";
        unlink('img/products/' . $id . '.png');

        if (mysqli_query($conn, $query)) {
        }
    } else if ($_POST['Page'] == 'save') {
    }
} else if (isset($_POST['name_field'])) {

    $id = $_POST['id'];
    $name = $_POST['name_field'];
    $price = $_POST['price_field'];
    $category = $_POST['category_field'];

    $ava = (isset($_POST['availability_field']) ? 1 : 0);
    $query = "UPDATE product SET Product_name = '$name', Price = $price, Availability = '$ava', category = '$category' WHERE Product_ID = $id ";

    unlink('img/product/' . $id . '.png');

    // Desired image name
    $image = $id . '.png';
    // image file directory
    $target = "img/products/" . $image;


    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        header('location: manage-products.php');
    } else {
        echo "Failed to upload image";
    }

    if (mysqli_query($conn, $query)) {
    }
}
