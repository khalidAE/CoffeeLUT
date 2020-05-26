<?php
session_start();

if (!isset($_SESSION['user_type'])) {
    header('location: index.php');
}

// Destroy session
session_destroy();
session_unset();

header('location: index.php');
?>