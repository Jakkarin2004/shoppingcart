
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Modal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* ซ่อน modal เริ่มต้น */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    background-color: #fff;
    margin: 1rem auto;
    padding: 20px;
    width: 70%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    text-align: center;
    height: auto;
    overflow: hidden;
}

/* ปุ่มปิด Modal */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

    </style>
</head>
<body>
    <button id="openModalBtn">เปิด Modal</button>
    <div id="simpleModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalBtn">&times;</span>
            <div class="">
                <label for=""></label>
                <input type="text" 
                name="product_name"
                value="<?php echo $result['product_name'];?>">
            </div>
        </div>
        <div class="modal-content">
            <div class="">
                <label for=""></label>
                <input type="text" 
                name="price"
                value="<?php echo $result['price'];?>">
            </div>
        </div>
        <div class=" mt-2">
                    <label class="form-label" for="formFile">Image :</label>
                    <input type="file" 
                    name="profile_image" 
                    class="input-file" 
                    placeholder="Enter Your Profile"
                    value=""
                    accept="image/png, image/jpg, image/jpeg"
                    >
                </div>
        <div class="modal-content">
            <div class="">
                <label for=""></label>
                <input type="text" 
                name="detail"
                value="<?php echo $result['detail'];?>">
            </div>
        </div>
    </div>
    <script>
        // เรียก Modal
const openModalBtn = document.getElementById("openModalBtn");
const modal = document.getElementById("simpleModal");

// ปุ่มปิด Modal
const closeModalBtn = document.getElementById("closeModalBtn");

// เปิด Modal
openModalBtn.addEventListener("click", () => {
    modal.style.display = "block";
});

// ปิด Modal เมื่อคลิกที่ปุ่มปิดหรือพื้นหลัง
closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

    </script>
</body>
</html>
