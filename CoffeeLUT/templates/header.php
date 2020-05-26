<?php

//

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coffee LUT</title>
    <link rel="icon" type="image/x-icon" href="icon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="icon.png" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- ----------------------------- -->
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="assets/js/main.js"></script>
    <link rel="stylesheet" href="assets/css/main.css">

    <?php
    if ($page == 'profile' || $page=='history') {
        echo '<link rel="stylesheet" href="assets/css/profile.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        ';
    }

    if ($page == 'edit-profile' || $page == 'cart' || $page=='payment' || $page=='contact') {
        echo '<link rel="stylesheet" href="assets/css/cart.css">';
    }

    if ($page=='products') {
        echo '<link rel="stylesheet" href="assets/css/products.css">';
    }

    if ($page=='payment') {
        echo '<link rel="stylesheet" href="assets/css/payment.css">';
    }
    ?>

</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid header">
            <a class="navbar-brand logo" href="index.php"><img src="logo2.png" class=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($page == 'home') {
                                                echo 'active';
                                            } ?> " href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-products.php?category=coffee">Coffee</a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            pages
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="category.html">Category</a>
                            <a class="dropdown-item" href="cart.html">cart</a>
                            <a class="dropdown-item" href="signin.html">sign in</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="address.html">address</a>
                            <a class="dropdown-item" href="payment.html">payment</a>
                            <a class="dropdown-item" href="contact.html">contact</a>
                        </div>
                    </li> -->

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" onclick="window.location.assign('all-products.php')" href="all-products.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            All Products
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="all-products.php?category=grinders">Grinderes</a>
                            <a class="dropdown-item" href="all-products.php?category=drippers">Dripperes</a>
                            <a class="dropdown-item" href="all-products.php?category=espresso-tools">Espresso Tools</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="all-products.php?category=cups-glasses">Cups & Glasses</a>
                            <a class="dropdown-item" href="all-products.php?category=kettles">Kettles</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact us</a>
                    </li>


                    <li class="nav-item dropdown ">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search"></i> </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <input type="text" name="" id="">
                            <!-- <button class="button-primary button-cricle">
                                <i class="fas fa-search"></i> </a>
                            </button> -->
                        </div>
                    </li>


                    <li class="nav-item">

                        <?php
                        if (isset($_SESSION['user_type']) && $_SESSION['user_type']=='customer') {
                            echo '
                            <a class="nav-link" href="cart.php">
                                <i class="fas fa-shopping-cart"></i>
                            </a>';
                        } ?>
                    </li>

                    <li class="nav-item">

                        <a class="nav-link <?php if ($page == 'profile' || $page == 'edit-profile') {
                                                echo 'active';
                                            } ?> " href="
                        <?php
                        if (isset($_SESSION['user_type'])) {
                            echo 'profile-' . $_SESSION['user_type'];
                        } else {
                            echo 'signin';
                        }
                        ?>.php">

                            <i class="fas fa-user-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item">

                        <?php
                        if (isset($_SESSION['user_type'])) {
                            echo '
                            <a class="nav-link" href="signout.php">
                                <i class="fas fa-sign-in-alt"></i>
                            </a>';
                        } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="header-banner">
        </div>
        <div class="clear"></div>
    </header>