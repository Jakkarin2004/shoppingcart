<?php
session_start();
include 'config.php';

//Product all
$query = mysqli_query($conn,"SELECT * FROM products ");
$row = mysqli_num_rows($query);

// var product form
$result = [
    'id' => '',
    'product_name' => '',
    'price' => '',
    'detail' => '',
    'product_image' => ''
];

//product select edit
if(!empty($_GET['id'])){
    $query_product = mysqli_query($conn,"SELECT * FROM products 
    WHERE id = '{$_GET['id']}' ");
    $row_product = mysqli_num_rows($query_product);

    if($row_product == 0){
            header('location'. $base_url . '/index.php');
    }

    $result = mysqli_fetch_array($query_product);
    // var_dump($result);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h4>Home - Manage Product</h4>
        <form action="<?php echo $base_url;?>/product-form.php"  
            method="post" 
            enctype="multipart/form-data" 
            class="control-main" >
            <input type="hidden" name="id" 
            value="<?php echo $result['id'];?>"
            >
            <div class="product_main">
                <div class="product-name">
                    <label class="form-label" for="">Product Name :</label>
                    <input class="input-item" 
                    type="text" 
                    name="product_name"
                    placeholder="Enter Your Product Name"
                    value="<?php echo $result['product_name'];?>"
                    >
                </div>
                <div class="product-price mt-2">
                    <label class="form-label" for="">Price :</label>
                    <input class="input-item" 
                    type="number" 
                    name="price"
                    placeholder="Enter Your Price"
                    value="<?php echo $result['price'];?>"
                    >
                </div>
                <div class="product-imge mt-2">
                    <label class="form-label" for="formFile">Image :</label>
                    <input type="file" 
                    name="profile_image" 
                    class="input-file" 
                    placeholder="Enter Your Profile"
                    value=""
                    accept="image/png, image/jpg, image/jpeg"
                    >
                    <?php if(!empty($result['profile_image'])): ?>
                        <img src="<?php echo $base_url;?>/upload_image/<?php echo $result['profile_image'];?>"  
                        alt="product Image" width="150">
                    <?php endif?>
                </div>
                <div class="product-detail mt-2">
                    <label class="form-label" for="formFile">Detail :</label>
                    <textarea 
                    class="input-item" 
                    name="detail" 
                    cols="30" 
                    rows="10"
                    >
                    <?php echo $result['detail'];?>
                    </textarea>
                    
                </div>
            </div>
            <?php if(empty($result['id'])): ?>
                <button class="btn btn-outline-success text-slate-500 text-center" type="submit"><i class="fa-regular fa-floppy-disk mr-1"></i>Create</button>
            <?php else:?>
                <button class="btn btn-outline-warning text-slate-500 text-center" type="submit"><i class="fa-regular fa-floppy-disk mr-1"></i>Update</button>
            <?php endif;?>
            <a role="button" class="btn btn-outline-danger text-slate-500 text-center"
            href="<?php echo $base_url;?>/index.php"
            >
            <i class="fa-solid fa-rotate-right mr-1"></i>Cancel</a>
            <hr class="my-4">
        </form>

       <div class="row mt-">
        <div class="col-12 mt-5">
            <table class="table table-bordered border-stone-400">
                <thead>
                    <tr class="text-center">
                        <th class="col-1">Image</th>
                        <th class="col-2">Product Name</th>
                        <th class="col-2">Price</th>
                        <th class="col-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($row > 0):?>
                        <?php while($product = mysqli_fetch_array($query)):?>
                        <tr>
                            <td class="col-1">
                                <?php if(!empty($product['profile_image'])):?>
                                    <img src="<?php echo $base_url;?>/upload_image/<?php echo $product['profile_image'];?>"  
                                    alt="product Image">
                                <?php else:?>
                                    <img src="<?php echo $base_url;?>/assets/images/no-image.png" 
                                    alt="product Image">
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
                            <td class="col-2 ">
                                <div class="btn-main">
                                    <a role="button" 
                                    href="<?php echo $base_url;?>/index.php?id=<?php echo $product['id'];?>"
                                    class="btn btn-outline-dark mr-4"
                                    ><i class="fa-regular fa-pen-to-square mr-1"></i>Edit</a>
                                    <a role="button" 
                                    href="<?php echo $base_url;?>/product-delete.php?id=<?php echo $product['id'];?>"
                                    class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this product');"
                                    ><i class="fa-solid fa-trash mr-1"></i>Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4" >
                            <h4 class="text-center text-denger">ไม่มีรายการสินค้า</h4>
                        </td>
                    </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
       </div>
    </div>
</body>
</html>