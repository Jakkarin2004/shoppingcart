<?php 
session_start();
include 'config.php';

foreach($_SESSION['cart'] as $productID => $productQty){
    $_SESSION['cart'][$productID] = $_POST['product'][$productID]['quantity'];
    // var_dump($_POST['product'][$productID]['quantity']);
}

$_SESSION['message'] = 'Cart Update success';
header('location:' . $base_url . '/cart.php');
?>