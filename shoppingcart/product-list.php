<?php
session_start();
include 'config.php';

//Product all
$query = mysqli_query($conn,"SELECT * FROM products ");
$row = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-main">
    <?php include 'include/menu.php' ?>
    <div class="contaner-main">
        <!-- alert ข้อมูล -->
        <?php if (!empty($_SESSION['message'])){?>
            <div class="alert alert-success alert-dismissible fade show" row="alert">
                <?php echo $_SESSION['message'];?>
                <p type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></p>
                <?php unset($_SESSION['message']);?>
            </div>
        <?php }?>
        <h4>Home -> Product List</h4>
       <div class="row mt-">
            <?php if($row > 0):?>
                <?php while($product = mysqli_fetch_assoc($query)): ?>
                        <div class="col-3 mt-3 mb-3">
                            <div class="card" style="width: 16rem;">
                                <?php if(!empty($product['profile_image'])):?>
                                    <img src="<?php echo $base_url;?>/upload_image/<?php echo $product['profile_image'];?>"  
                                    alt="product Image" class="card-img-top">
                                <?php else:?>
                                    <img src="<?php echo $base_url;?>/assets/images/no-image.png" 
                                    alt="product Image">
                                <?php endif?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['product_name'];?></h5>
                                    <small class="font-bold card-text text-success mb-0">
                                     ฿ <?php echo nl2br($product['price']);?></small>
                                    <p class="card-text text-muted ">รายละเอียด : <?php echo nl2br($product['detail']);?></p>
                                    <a href="<?php echo $base_url?>/cart-add.php?id=<?php echo $product['id'];?>" 
                                    class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping mr-1"></i>Add Cart</a>
                                </div>
                            </div>
                        </div>
                <?php endwhile;?>
                <?php else: ?>
                    <div class="col-12">
                        <h4 class="danger">ไม่มีรายการสินค้า</h4>
                    </div>
            <?php endif;?>
       </div>
    </div>
</body>
</html>