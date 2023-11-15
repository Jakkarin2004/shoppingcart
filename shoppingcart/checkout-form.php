<?php 
session_start();
include 'config.php';

$query = mysqli_query($conn,"INSERT INTO orders (order_date,fullname,email,tel,grand_total)  
    VALUE('{$_POST['order_date']}','{$_POST['fullname']}','{$_POST['email']}','{$_POST['tel']}','{$_POST['grand_total']}')") 
    or die('query failed');

if($query){
    $last_id = mysqli_insert_id($conn);
    foreach($_SESSION['cart'] as $productID => $productQty){
        $product_name = $_POST['product'][$productID]['name'];
        $price = $_POST['product'][$productID]['price'];
        $total = $price * $productQty;
    
            mysqli_query($conn,"INSERT INTO order_details (order_id ,product_id ,product_name,price,quantitry,total) VALUE ('{$last_id}','{$productID}','{$product_name}','{$price}','{$productQty}','{$total}')") or die('query failed'); 
        }

    mysqli_close($conn);
    unset($_SESSION['cart']);
    $_SESSION['message'] = 'Chckout Order success';
    header('location:' . $base_url . '/product-list.php');
}else{
    $_SESSION['message'] = 'Cechout not complete';
    header('location:' . $base_url . '/product-list.php');
}
?>