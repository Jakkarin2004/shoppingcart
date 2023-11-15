<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./include/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Niramit:wght@500&family=Taviraj&display=swap" rel="stylesheet">
</head>
<body> 
<nav class="nav-navbar">
        <ul>
            <li><a href="<?php echo $base_url;?>/index_result.php">หน้า User</a></li>
            <li><a href="<?php echo $base_url;?>/index.php">เพิ่มข้อมูล</a></li>
            <li>
                <a href="<?php echo $base_url;?>/product-list.php">รายการสินค้า</a>
            </li>
            <li><a href="<?php echo $base_url;?>/cart.php">ตะกร้า(<?php echo count($_SESSION['cart'] ?? []);?>)</a></li>
        </ul>
</nav>
</body>
</html>
