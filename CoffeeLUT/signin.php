<?php
session_start();
require('mysqli_connect.php');

if (isset($_SESSION['user_type'])) {
    header('location: index.php');
}

if (isset($_POST['signup'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password); // hash password

    // Check if email already exists in the db
    $query = "SELECT Email from customer";
    $result = $conn->query($query);

    $duplicate_email = false;

    while ($row = $result->fetch_assoc()) {
        if ($row['Email'] == $email)
            $duplicate_email = true;
    }

    if ($duplicate_email) {
        $error_msg_signup = 'There is already an account with this email address!';
    } else {
        $query = "INSERT INTO customer(First_name, Last_name, Email, Password_) VALUES ('$fname', '$lname', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
        } else {
        }
    }
    $_POST = array();
}

if (isset($_POST['signin'])) {

    $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password); // hash password

    $query = "SELECT * FROM customer WHERE Email = '$email' AND Password_ = '$password'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    if ($data) {
        if (count($data) > 0) {
            $_SESSION['customer_ID'] = $data['Customer_ID'];
            $_SESSION['user_type'] = 'customer';
            $_SESSION['first_name'] = $data['First_name'];
            header('location: index.php');
        }
    } else {
        // Check Staff table
        $query = "SELECT * FROM staff WHERE Email = '$email' AND Password_ = '$password'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);

        if ($data) {
            if (count($data) > 0) {
                $_SESSION['staff_ID'] = $data['Staff_ID'];
                $_SESSION['user_type'] = 'staff';
                $_SESSION['first_name'] = $data['First_name'];
                header('location: index.php');
            }
        } else {
            // Check Admin table
            $query = "SELECT * FROM admin WHERE Email = '$email' AND Password_ = '$password'";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_array($result);

            if ($data) {
                if (count($data) > 0) {
                    $_SESSION['admin_ID'] = $data['Admin_ID'];
                    $_SESSION['user_type'] = 'admin';
                    $_SESSION['first_name'] = $data['First_name'];
                    header('location: index.php');
                }
            } else {
                $error_msg_signin = 'You did not sign in with a correct credentials or your account is disabled.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In — Coffee LUT</title>
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
    <link rel="stylesheet" href="assets/css/signin.css">
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-products.php?category=coffee">Coffee</a>
                    </li>

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
                        </div>
                    </li>
                    <li class="nav-item">

                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="signin.php">
                            <i class="fas fa-user-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="header-banner">

            <div class="container signin-container" id="container">
                <div class="form-container sign-up-container">
                    <form method='POST' action="signin.php">
                        <h1>Sign up</h1>
                        <span style="color: red">
                            <?php
                            if (isset($error_msg_signup)) {
                                echo $error_msg_signup;
                            }
                            ?>
                        </span> <span></span>
                        <input type="text" placeholder="First Name" name="fname" required />
                        <input type="text" placeholder="Last Name" name="lname" required />
                        <input type="email" placeholder="Email" name="email" required />
                        <input type="password" placeholder="Password" name="password" required />
                        <button type="submit" class="button-primary" name="signup">Sign Up</button>
                    </form>
                </div>
                <div class="form-container sign-in-container">
                    <form method="POST" action="signin.php">
                        <h1>Sign in</h1>
                        <div class="social-container">
                        </div>
                        <span style="color: red">
                            <?php
                            if (isset($error_msg_signin)) {
                                echo $error_msg_signin;
                            }
                            ?>
                        </span>
                        <input type="email" placeholder="Email" name="email" required />
                        <input type="password" placeholder="Password" name="password" required />
                        <a href="#">Forgot your password?</a>
                        <button type="submit" class="button-primary" name="signin">Sign In</button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1>Welcome Back!</h1>
                            <p>To keep connected, please login with your personal info</p>
                            <button class="button-secondary" id="signIn">Sign In</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Hello!</h1>
                            <p>Enter your personal details and start journey with us</p>
                            <button class="button-secondary" id="signUp">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clear">
        </div>
    </header>



    <!-- Footer -->
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        signUpButton.addEventListener('click', () =>
            container.classList.add('right-panel-active'));
        signInButton.addEventListener('click', () =>
            container.classList.remove('right-panel-active'));
    </script>

</body>
</html>