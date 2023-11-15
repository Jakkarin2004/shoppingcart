<?php
session_start();
include 'config.php';

$productIds = [];
foreach(($_SESSION['cart'] ?? []) as $cartId => $cartQty){
    $productIds[] = $cartId;
}

$ids = 0;
if(count($productIds) > 0){
    $ids = implode(',',$productIds);
}

//Product all
$query = mysqli_query($conn,"SELECT * FROM products WHERE id IN ($ids)");
$row = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        <h4>Home -> Cart</h4>
       <div class="row mt-">
          <div class="col-12">
            <form action="<?php echo $base_url;?>/cart-update.php"
            method="post"
            >
                <table class="table table-bordered border-stone-400">
                        <thead>
                            <tr class="text-center">
                                <th style="width:100px">Image</th>
                                <th style="width:100px">Product Name</th>
                                <th style="width:200px">Price</th>
                                <th style="width:100px">Quantity</th>
                                <th style="width:200px">Total</th>
                                <th style="width:120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($row > 0):?>
                                <?php while($product = mysqli_fetch_array($query)):?>
                                <tr>
                                    <td class="col-1">
                                        <?php if(!empty($product['profile_image'])):?>
                                            <img src="<?php echo $base_url;?>/upload_image/<?php echo $product['profile_image'];?>"  
                                            alt="product Image" style="width:100px">
                                        <?php else:?>
                                            <img src="<?php echo $base_url;?>/assets/images/no-image.png.png" 
                                            alt="product Image" style="width:100px">
                                        <?php endif?>
                                    </td>
                                    <td class="col-2">
                                        <?php echo $product['product_name'];?>
                                        <div>
                                            <small class="text-muted">
                                                <?php echo nl2br($product['detail']);?>
                                            </small>
                                        </div>
                                    </td>
                                    <td class="col-2">
                                        <?php echo number_format($product['price'],2);?>
                                    </td>
                                    <td class="col-2">
                                    <input type="number" 
                                    name="product[<?php echo $product['id'];?>][quantity]" 
                                    value="<?php echo $_SESSION['cart'][$product['id']]; ?>" 
                                    class="form-control"
                                    >
                                    </td>
                                    <td class="col-2">
                                        <?php echo number_format($product['price'] * $_SESSION['cart'][$product['id']],2); ?>
                                    </td>
                                    <td class="col-2 ">
                                        <div class="btn-main">
                                            <a role="button" 
                                            href="<?php echo $base_url;?>/cart-delete.php?id=<?php echo $product['id'];?>"
                                            class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this product');"
                                            ><i class="fa-solid fa-trash mr-1"></i>Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <button type="submit" 
                                        class="btn btn-warning w-40"
                                        >
                                        Update Cart
                                        </button>
                                        <a href="<?php echo $base_url?>/checkout.php" 
                                        class="btn btn-outline-success w-40"
                                        >Checkout Order</a>
                                    </td>
                                </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="6" >
                                    <h4 class="text-center text-denger">ไม่มีรายการสินค้าในตระกร้า</h4>
                                </td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
            </form>
          </div>
       </div>
    </div>
</body>
</html>