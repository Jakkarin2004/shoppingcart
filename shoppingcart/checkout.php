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
$query = mysqli_query($conn,"SELECT * FROM products 
WHERE id IN ($ids)");
$row = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .contaner-main {
    width: 1100px;
    margin: 0 auto;
    margin-top: 1.5rem;
    padding: 1rem;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 0px 5px rgb(190, 190, 190);
}

    </style>
</head>
<body>
<div class="contaner-main">
  <form action="<?php echo $base_url; ?>/checkout-form.php" method="post">
  <main>
    <div class="row g-5 ">
      <div class="col-md-5 col-lg-4 order-md-last ">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary mt-5">Your cart</span>
          <span class="badge bg-primary rounded-pill mt-5"><?php echo $row;?></span>
        </h4>
        <?php if($row > 0):?>
        <ul class="list-group mb-3">
            <?php $grand_total = 0;?>
            <?php while($product = mysqli_fetch_assoc($query)):?>
          <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0"><?php echo $product['product_name'];?>(<?php echo $_SESSION['cart'][$product['id']]; ?>)</h6>
                    <small class="text-muted"><?php echo nl2br($product['detail']);?></small>
                    <input type="hidden" name="product[<?php echo $product['id']; ?>][price]" value="<?php echo $product['price']; ?>">
                    <input type="hidden" name="product[<?php echo $product['id']; ?>][name]" value="<?php echo $product['product_name']; ?>">
                </div>
                <span class="text-muted"><?php echo number_format($product['price'] * $_SESSION['cart'][$product['id']],2); ?>฿</span>
          </li>
          <?php $grand_total += $_SESSION['cart'][$product['id']]*$product['price'];?>
          <?php endwhile;?>
            <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                <h6 class="my-0">Grand Total</h6>
                <small>amount</small>
                </div>
                <span class="text-success"><strong><?php echo number_format($grand_total,2);?></strong></span>
            </li>
            </ul>
            <input type="hidden" name="grand_total" value="<?php echo $grand_total;?>">
        <?php endif;?>
      </div>
      <div class="col-md-7 col-lg-8 ">
            <h1 class="md-5 font-bold text-xl">Checkout</h1>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label ">Fullname</label>
              <input type="text" class="form-control" 
              id="firstName" placeholder="" 
              value="" 
              name="fullname"
              required>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label ">Tell</label>
              <input type="number" class="form-control"  placeholder="" value="" 
              name="tel"
              required>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label ">Date</label>
              <input type="date" class="form-control" id="order_date" placeholder="" value="" 
              name="order_date"
              required>
            </div>


            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control"
              name="email" 
              id="email" >
            </div>

            <div class="text-end">
                <a href="<?php echo $base_url; ?>/product-list.php" class="btn btn-secondary" role="button">Back to product</a>
                <button class="btn bg-blue-500  text-white" type="submit">Continue to checkout</button>
            </div>   
      </div>
    </div>
  </main>
  </form>
</div>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <script src="form-validation.js"></script>
</body>
</html>